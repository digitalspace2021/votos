<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CargoController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Cargo;
        parent::__construct($this->model);
    }

    public function tabla()
    {
        return DataTables::of($this->model::query())
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
            'name' => 'required',
            'descripcion' => 'nullable'
        ]);

        $item =  $this->model;
        $item->name = $request->name;
        $item->descripcion = $request->descripcion ?? ' ';
        $item->save();

        Alert::success(trans($this->className), 'Se ha creado el ' . $this->singular . ' con exito!');
        return redirect()->route(trans($this->plural));
    }

    public function actualizar(Request $request, $id)
    {
        $cargo = $this->model::find($id);
        if (!$cargo) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }
        return view(trans($this->plural) . '.actualizar', compact('cargo'));
    }

    public function actualizar_guardar(Request $request, $id)
    {
        $item = $this->model::find($id);
        if (!$item) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }

        $request->validate([
            'name' => 'required',
            'descripcion' => 'nullable'
        ]);

        $item->name = $request->name;
        $item->descripcion = $request->descripcion ?? ' ';
        $item->save();

        Alert::success(trans($this->className), 'Se ha actualizado el ' . $this->singular . ' con exito!');
        return redirect()->route(trans($this->plural));
    }

    public function ver(Request $request, $id)
    {
        $cargo = $this->model::find($id);
        if (!$cargo) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }
        return view(trans($this->plural) . '.ver', compact('cargo'));
    }

    public function eliminar(Request $request, $id)
    {

        $cargo = $this->model::find($id);

        if (!$cargo) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }
        return view(trans($this->plural) . '.eliminar', compact('cargo'));
    }

    public function eliminar_confirmar(Request $request, $id)
    {
        $cargo = $this->model::find($id);

        if (DB::table('candidatos')->where('cargo_id', $id)->get()) {
            Alert::error(trans($this->className), 'No puedes eliminar este cargo ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }

        if (!$cargo) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . $this->singular . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }
        $cargo->delete();
        Alert::success(trans($this->className), 'Se ha eliminado el ' . $this->singular . ' con exito.');
        return redirect()->route(trans($this->plural));
    }
}
