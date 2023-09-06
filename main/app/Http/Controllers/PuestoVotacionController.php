<?php

namespace App\Http\Controllers;

use App\Models\PuestoVotacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PuestoVotacionController extends Controller
{

    protected $model;
    public function __construct()
    {
        $this->model = new PuestoVotacion();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunas = DB::table('comunas')->select('id','name')->get();
        $barrios = DB::table('barrios')->select('id','name')->get();
        $corregimientos = DB::table('corregimientos')->select('id','name')->get();
        $veredas = DB::table('veredas')->select('id','name')->get();
        return view('puestosVotacion.index',['comunas'=>$comunas,'barrios'=>$barrios,'corregimientos'=>$corregimientos,'veredas'=>$veredas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('puestosVotacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'inputName' => 'required|max:255',
            'inputDescript' => 'max:255',
            'selectTypeZone' => 'required|max:600',
            'zone' => 'required|max:255'    
        ]);

        $puestoVotacion = $this->model;
        $puestoVotacion -> name = $request->inputName;
        $puestoVotacion -> description = $request->inputDescript;
        $puestoVotacion -> zone_type = $request->selectTypeZone;
        $puestoVotacion -> zone = $request->zone;
        $puestoVotacion -> save();

        Alert::success('puesto de votacion', 'Se ha creado el puesto de votacion con exito!');
        return redirect()->route('puestoVotacion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PuestoVotacion  $puestoVotacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty($id)){
            $puestoVotacion = PuestoVotacion::join('barrios', 'puestos_votacion.zone', '=', 'barrios.id')
            ->leftJoin('comunas','barrios.comuna_id','=','comunas.id')
            ->leftJoin('veredas', 'puestos_votacion.zone', '=', 'veredas.id')
            ->leftJoin('corregimientos','veredas.corregimiento_id','=','corregimientos.id')
            ->select('puestos_votacion.*',
                    DB::raw("CASE puestos_votacion.zone_type WHEN 'Comuna' THEN barrios.name WHEN 'Corregimiento' THEN veredas.name END as zona"))
            ->where('puestos_votacion.id', $id) 
            ->get();
        }
        return view('puestosVotacion.view',['puestoVotacion' => $puestoVotacion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PuestoVotacion  $puestoVotacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!empty($id)){
            $puestoVotacion = PuestoVotacion::join('barrios', 'puestos_votacion.zone', '=', 'barrios.id')
            ->leftJoin('comunas','barrios.comuna_id','=','comunas.id')
            ->leftJoin('veredas', 'puestos_votacion.zone', '=', 'veredas.id')
            ->leftJoin('corregimientos','veredas.corregimiento_id','=','corregimientos.id')
            ->select('puestos_votacion.*',
                    DB::raw("CASE puestos_votacion.zone_type WHEN 'Comuna' THEN barrios.name WHEN 'Corregimiento' THEN veredas.name END as zona"))
            ->where('puestos_votacion.id', $id) 
            ->get();
        }
        //dd($puestoVotacion);
        return view('puestosVotacion.edit',['puestoVotacion' => $puestoVotacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PuestoVotacion  $puestoVotacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'inputName' => 'required|max:255',
            'inputDescript' => 'max:255',
            'selectTypeZone' => 'required|max:600',
            'zone' => 'required|max:255'    
        ]);

        $puestoVotacion = $this->model::find($id);
        if (!$puestoVotacion) {
            Alert::error('PuestoVotacion', 'No se ha encontrado el puesto solicitado.');
            return redirect()->route('puestoVotacion.index');
        }

        $puestoVotacion -> name = $request->inputName;
        $puestoVotacion -> description = $request->inputDescript;
        $puestoVotacion -> zone_type = $request->selectTypeZone;
        $puestoVotacion -> zone = $request->zone;
        $puestoVotacion -> save();

        Alert::success('puesto de votacion', 'Se ha actualizado el puesto de votacion con exito!');
        return redirect()->route('puestoVotacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PuestoVotacion  $puestoVotacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $puestoVotacion = $this->model::find($id);
        if (!$puestoVotacion) {
            Alert::error('PuestoVotacion', 'No se ha encontrado el puesto solicitado.');
            return redirect()->route('puestoVotacion.index');
        }

        $puestoVotacion->delete();

        Alert::success('PuestoVotacion', 'Se ha eliminado el puesto de votacion con exito.');
        return redirect()->route('puestoVotacion.index');
    }

    //Query data and send to the main datatable.
    public function tabla(Request $request)
    {  
        $puestoVotacion = PuestoVotacion::query();
        if(!empty($request->nombre)){$puestoVotacion->where('puestos_votacion.name', 'LIKE', '%' . $request->nombre . '%');}
        if(!empty($request->comuna)){
            $puestoVotacion->where('puestos_votacion.zone_type','Comuna')
                        ->where('barrios.comuna_id',$request->comuna);
        }
        if(!empty($request->barrio)){
            $puestoVotacion->where('puestos_votacion.zone_type','Comuna')
                        ->where('puestos_votacion.zone',$request->barrio);
        }
        if(!empty($request->corregimiento)){
            $puestoVotacion->where('puestos_votacion.zone_type','Corregimiento')
                        ->where('veredas.corregimiento_id',$request->corregimiento);
        }
        if(!empty($request->vereda)){
            $puestoVotacion->where('puestos_votacion.zone_type','Corregimiento')
                        ->where('puestos_votacion.zone',$request->vereda);
        }
        
        $puestoVotacion->leftJoin('barrios', 'puestos_votacion.zone', '=', 'barrios.id')
            ->leftJoin('comunas','barrios.comuna_id','=','comunas.id')
            ->leftJoin('veredas', 'puestos_votacion.zone', '=', 'veredas.id')
            ->leftJoin('corregimientos','veredas.corregimiento_id','=','corregimientos.id')
            ->select('puestos_votacion.id as id','puestos_votacion.name as nombre','puestos_votacion.description as descripcion',
                     'puestos_votacion.zone_type as tipoZona',
                      DB::raw("CASE puestos_votacion.zone_type WHEN 'Comuna' THEN barrios.name WHEN 'Corregimiento' THEN veredas.name END as zona"))
            
            ->orderBy('puestos_votacion.id');

            return DataTables::eloquent($puestoVotacion)
            ->addColumn('acciones', function ($col) {
                $btn =  '<a href="'.route('puestoVotacion.show',['id'=>$col->id]).'" class="btn btn-outline-secondary" title="Ver "><i class="fa fa-eye"></i></a>';
                if (Auth::user()->hasRole('administrador')) {
                    $btn .= '<a href="'.route('puestoVotacion.edit',['id'=>$col->id]).'" class="btn btn-outline-primary m-2" title="Editar "><i class="fa fa-edit"></i></a>';
                    $btn .= '<a href="'.route('puestoVotacion.delete',['id'=>$col->id]).'" class="btn btn-outline-danger" title="Eliminar "><i class="fa fa-times"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);     
    }
}
