<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Formulario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function tabla()
    {
        /* only register if not have relation with problems or if has the estado in problems is true */
        /* $forms = $this->model::whereDoesntHave('problem', function ($query) {
            $query->where('estado', false);
        })->orWhereDoesntHave('problem'); */
        
        return Datatables::of($this->model::where('estado', true)->get())
            ->addColumn('creador', function ($col) {
                $creador = User::find($col->propietario_id);
                return $creador ? $creador->name : '-';
            })
            ->editColumn('nombre', function ($col) {
                return $col->nombre . ' ' . $col->apellido;
            })
            ->editColumn('updated_at', function ($col) {
                return Carbon::parse($col->updated_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('acciones', function ($col) {
                $btn =  '<a href="' . route(trans($this->plural) . '.ver', $col->id) . '" class="btn btn-outline-secondary" title="Ver ' . trans($this->singular) . '"><i class="fa fa-eye"></i></a>';
                if (Auth::user()->hasRole('administrador')) {
                    $btn .= '<a href="' . route(trans($this->plural) . '.actualizar', $col->id) . '" class="btn btn-outline-primary m-2" title="Editar ' . trans($this->singular) . '"><i class="fa fa-edit"></i></a>';
                    $btn .= '<a href="' . route(trans($this->plural) . '.eliminar', $col->id) . '" class="btn btn-outline-danger" title="Eliminar ' . trans($this->singular) . '"><i class="fa fa-times"></i></a>';
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
            'identificacion' => 'required|max:12',
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

        $formulario->candidato_nombre = Candidato::find($formulario->candidato_id)->name;
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
