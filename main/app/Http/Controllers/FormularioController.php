<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Formulario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;

class FormularioController extends Controller
{

    protected $model;
    public function __construct()
    {
        $this->model = new Formulario;
        parent::__construct($this->model);
    }

    public function index(){
        $comunas = DB::table('comunas')->select('id','name')->get();
        $barrios = DB::table('barrios')->select('id','name')->get();
        $candidatos = Candidato::select('id','name')->get();
        $creadores = User::select('id','name');

        if(env('USERS_TEST')){
            $creadores = $creadores->where(function ($query){
                $query->where('name', '!=', 'Admin')
                    ->where('name', '!=', 'simple');
            });
        }

        $corregimientos = DB::table('corregimientos')->select('id','name')->get();
        $veredas = DB::table('veredas')->select('id','name')->get();
        return view('formularios.index',['candidatos'=>$candidatos,'creadores'=>$creadores->get(),
                    'comunas'=>$comunas,'barrios'=>$barrios,'corregimientos'=>$corregimientos,
                    'veredas'=>$veredas]);
    }

    public function tabla(Request $request)
    {
        $formularios = $this->model::query();
        $formularios->join('barrios', 'formularios.zona', '=', 'barrios.id')->join('comunas','barrios.comuna_id','=','comunas.id');
        $formularios->join('veredas', 'formularios.zona', '=', 'veredas.id')->join('corregimientos','veredas.corregimiento_id','=','corregimientos.id');
        if(!empty($candidato = $request->candidato)){$formularios->where(function ($query) use ($candidato) {
            $query->where('candidato_id', $candidato)
                ->orWhereNull('candidato_id');
        });}
        if(!empty($request->creador)){$formularios->where('formularios.propietario_id',$request->creador);}
        if(!empty($request->cedula)){$formularios->where('formularios.identificacion',$request->cedula);}
        if(!empty($request->nombre)){$formularios->where('formularios.nombre', 'LIKE', '%' . $request->nombre . '%');}
        if(!empty($request->comuna)){
            $formularios->where('formularios.tipo_zona','comuna')
                        ->where('barrios.comuna_id',$request->comuna);
        }
        if(!empty($request->barrio)){
            $formularios->where('formularios.tipo_zona','comuna')
                        ->where('formularios.zona',$request->barrio);
        }
        if(!empty($request->corregimiento)){
            $formularios->where('formularios.tipo_zona','corregimiento')
                        ->where('veredas.corregimiento_id',$request->corregimiento);
        }
        if(!empty($request->vereda)){
            $formularios->where('formularios.tipo_zona','corregimiento')
                        ->where('formularios.zona',$request->vereda);
        }
        if(!empty($request->fecha)){$formularios->whereDate(DB::raw('DATE(created_at)'), '=', $request->fecha);}
       $formularios->select('formularios.id as id','formularios.propietario_id as propietario_id','formularios.identificacion as identificacion','formularios.nombre as nombre',
                            'formularios.apellido as apellido','formularios.email as email','formularios.telefono as telefono',
                            'formularios.direccion as direccion', 'formularios.puesto_votacion as puesto_votacion',
                            'formularios.updated_at as updated_at')
                    ->where('formularios.estado', true);

        return Datatables::of($formularios)
            ->addColumn('creador', function ($col) {
                $creador = User::find($col->propietario_id);
                return $creador ? $creador->name : '-';
            })
            ->editColumn('nombre', function ($col) {
                return $col->nombre . ' ' . $col->apellido;
            })
            ->editColumn('created_at', function ($col) {
                return Carbon::parse($col->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('acciones', function ($col) {
                $btn =  '<a href="' . route(trans($this->plural) . '.ver', $col->id) . '" class="btn btn-outline-secondary btn-sm" title="Ver ' . trans($this->singular) . '"><i class="fa fa-eye"></i></a>';
                if (Auth::user()->hasRole('administrador')) {
                    $btn .= '<a href="' . route(trans($this->plural) . '.actualizar', $col->id) . '" class="btn btn-outline-primary m-2 btn-sm" title="Editar ' . trans($this->singular) . '"><i class="fa fa-edit"></i></a>';
                    $btn .= '<a href="' . route(trans($this->plural) . '.eliminar', $col->id) . '" class="btn btn-outline-danger btn-sm" title="Eliminar ' . trans($this->singular) . '"><i class="fa fa-times"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function crear_guardar(Request $request)
    {
        $request->validate([
            'creador_id' => 'required|exists:users,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'email' => 'required|email|max:255',
            'identificacion' => 'required|max:12|unique:formularios,identificacion',
            'telefono' => 'required|max:255',
            'genero' => 'required|max:255',
            'direccion' => 'required|max:255',
            // 'tipo_zona' => 'required',
            'zona' => 'required|max:255',
            'puesto_votacion' => 'required|max:255',
            'mensaje' => 'nullable'
        ]);

        $formulario =  $this->model;
        $formulario->propietario_id = $request->creador_id;
        $formulario->nombre = $request->nombres;
        $formulario->apellido = $request->apellidos;
        $formulario->email = $request->email;
        $formulario->telefono = $request->telefono;
        $formulario->genero = $request->genero;
        $formulario->direccion = $request->direccion;
        $formulario->tipo_zona = $request->tipo_zona;
        $formulario->zona = $request->zona;
        $formulario->puesto_votacion = $request->puesto_votacion;
        $formulario->mensaje = $request->mensaje;
        $formulario->candidato_id = $request->candidato_id;
        $formulario->identificacion = $request->identificacion;
        $formulario->save();

        Alert::success(trans($this->className), 'Se ha creado el ' . $this->singular . ' con exito!');
        return redirect()->route(trans($this->plural));
    }

    public function actualizar(Request $request, $id)
    {
        $formulario = $this->model::find($id);
        if (!$formulario) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }

        $formulario->candidato_nombre = Candidato::find($formulario->candidato_id)->name;
        $formulario->propietario_nombre = User::find($formulario->propietario_id)->name;
        return view(trans($this->plural) . '.actualizar', compact('formulario'));
    }

    public function actualizar_guardar(Request $request, $id)
    {
        $formulario = $this->model::find($id);
        if (!$formulario) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }

        $request->validate([
            'creador_id' => 'required|exists:users,id',
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|max:255',
            'genero' => 'required|max:255',
            'direccion' => 'required|max:255',
            'zona' => 'required|max:255',
            'tipo_zona' => 'required|max:255',
            'puesto_votacion' => 'required|max:255',
            'mensaje' => 'nullable'
        ]);

        $formulario->propietario_id = $request->creador_id;
        $formulario->nombre = $request->nombres;
        $formulario->apellido = $request->apellidos;
        $formulario->email = $request->email;
        $formulario->telefono = $request->telefono;
        $formulario->genero = $request->genero;
        $formulario->direccion = $request->direccion;
        $formulario->zona = $request->zona;
        $formulario->tipo_zona = $request->tipo_zona;
        $formulario->puesto_votacion = $request->puesto_votacion;
        $formulario->mensaje = $request->mensaje;
        $formulario->identificacion = $request->identificacion;
        $formulario->candidato_id = $request->candidato_id;
        $formulario->save();

        Alert::success(trans($this->className), 'Se ha actualizado el ' . $this->singular . ' con exito!');
        return redirect()->route(trans($this->plural));
    }

    public function ver(Request $request, $id)
    {
        $formulario = $this->model::find($id);
        if (!$formulario) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }

        $formulario->candidato_nombre = Candidato::find($formulario->candidato_id)->name ?? null;
        $formulario->propietario_nombre = User::find($formulario->propietario_id)->name;
        return view(trans($this->plural) . '.ver', compact('formulario'));
    }

    public function eliminar(Request $request, $id)
    {
        $formulario = $this->model::find($id);
        if (!$formulario) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }
        $formulario->candidato_nombre = Candidato::find($formulario->candidato_id)->name;
        $formulario->propietario_nombre = User::find($formulario->propietario_id)->name;
        return view(trans($this->plural) . '.eliminar', compact('formulario'));
    }

    public function eliminar_confirmar(Request $request, $id)
    {
        $formulario = $this->model::find($id);
        if (!$formulario) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }

        $formulario->delete();

        Alert::success(trans($this->className), 'Se ha eliminado el ' . $this->singular . ' con exito.');
        return redirect()->route(trans($this->plural));
    }
}