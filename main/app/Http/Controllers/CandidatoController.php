<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Http\Requests\StoreCandidatoRequest;
use App\Http\Requests\UpdateCandidatoRequest;
use App\Traits\Listusers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CandidatoController extends Controller
{

    use Listusers;
    protected $model;
    public function __construct()
    {
        $this->model = new Candidato;
        parent::__construct($this->model);
    }

    public function tabla()
    {
        return DataTables::of($this->model::query())
            ->addColumn('cargo', function ($col) {
                return $col->cargo->name;
            })
            ->editColumn('updated_at', function ($col) {
                return Carbon::parse($col->updated_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('acciones', function ($col) {
                $btn =  '<a href="' . route($this->plural . '.ver', $col->id) . '" class="btn btn-outline-secondary" title="Ver ' . trans($this->singular) . '"><i class="fa fa-eye"></i></a>';
                if (Auth::user()->hasRole('administrador')) {
                    $btn .= '<a href="' . route($this->plural . '.actualizar', $col->id) . '" class="btn btn-outline-primary m-2" title="Editar ' . trans($this->singular) . '"><i class="fa fa-edit"></i></a>';
                    $btn .= '<a href="' . route($this->plural . '.eliminar', $col->id) . '" class="btn btn-outline-danger" title="Eliminar ' . trans($this->singular) . '"><i class="fa fa-times"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }



    public function crear()
    {
        $cargos = DB::table('cargos')->select('name', 'id')->get();
        return view(trans($this->plural) . ".crear", compact('cargos'));
    }

    public function crear_guardar(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'identifcacion' => 'required|max:255',
            'telefono' => 'required|max:255',
            'direccion' => 'required|max:255',
            'cargo_id' => 'required',
        ]);

        $this->assigneValues($request)->save();

        Alert::success(trans($this->className), 'Se ha creado el ' . $this->singular . ' con exito!');
        return redirect()->route(trans($this->plural));
    }

    public function actualizar(Request $request, $id)
    {
        $candidato = $this->model::find($id);
        if (!$candidato) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }
        $cargos = DB::table('cargos')->select('name', 'id')->get();
        return view(trans($this->plural) . '.actualizar', compact('candidato', 'cargos'));
    }

    public function actualizar_guardar(Request $request, $id)
    {
        $candidato = $this->model::find($id);
        if (!$candidato) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }

        $request->validate([
            'name' => 'required|max:255',
            'identifcacion' => 'required|max:255',
            'telefono' => 'required|max:255',
            'direccion' => 'required|max:255',
            'cargo_id' => 'required',
        ]);

        $this->assigneValues($request, $candidato)->save();

        Alert::success(trans($this->className), 'Se ha actualizado el ' . $this->singular . ' con exito!');
        return redirect()->route(trans($this->plural));
    }

    public function ver(Request $request, $id)
    {
        $candidato = $this->model::find($id);
        if (!$candidato) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }
        $cargos = DB::table('cargos')->select('name', 'id')->get();
        return view(trans($this->plural) . '.ver', compact('candidato', 'cargos'));
    }

    public function eliminar(Request $request, $id)
    {
        $candidato = $this->model::find($id);
        if (!$candidato) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }
        $cargos = DB::table('cargos')->select('name', 'id')->get();
        return view(trans($this->plural) . '.eliminar', compact('candidato', 'cargos'));
    }

    public function eliminar_confirmar(Request $request, $id)
    {
        $candidato = $this->model::find($id);
        if (!$candidato) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }
        $candidato->delete();

        Alert::success(trans($this->className), 'Se ha eliminado el ' . $this->singular . ' con exito.');
        return redirect()->route(trans($this->plural));
    }

    public function assigneValues($request, $model = null)
    {
        $item =  $model ?? $this->model;
        $item->name = $request->name;
        $item->identifcacion = $request->identifcacion;
        $item->telefono = $request->telefono;
        $item->direccion = $request->direccion;
        $item->cargo_id = $request->cargo_id;
        $item->email = ' ';
        return $item;
    }
}
