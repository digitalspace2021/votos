<?php

namespace App\Http\Controllers;

use App\Models\MesaVotacion;
use App\Models\mesas;
use App\Models\PuestoVotacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class MesaVotacionController extends Controller
{
    protected $model;
    protected $modelPuestosVotacion;

    public function __construct()
    {
        $this->model = new MesaVotacion();
        $this->modelPuestosVotacion = new PuestoVotacion();
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
        $puestos = $this->modelPuestosVotacion::select('id','name')->get();
        return view('mesasVotacion.index',['comunas'=>$comunas,'barrios'=>$barrios,'corregimientos'=>$corregimientos,'veredas'=>$veredas,'puestos'=>$puestos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $puestos = $this->modelPuestosVotacion::select('id','name')->get();
        return view('mesasVotacion.create',['puestosVotacion'=>$puestos]);
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
            'inputNumberTable' => 'required|max:255',
            'inputDescript' => 'required|max:255',
            'selectPolling_post' => 'required|max:600'  
        ]);

        $mesa = $this->model;
        $mesa -> numero_mesa = $request->inputNumberTable;
        $mesa -> descripcion = $request->inputDescript;
        $mesa -> puesto_votacion = $request->selectPolling_post;
        $mesa -> save(); 

        Alert::success('Mesa de votacion', 'Se ha creado la mesa de votacion con exito!');
        return redirect()->route('mesas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MesaVotacion  $mesaVotacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mesa = $this->model::join('puestos_votacion', 'mesas_votacion.puesto_votacion', '=', 'puestos_votacion.id')
        ->where('mesas_votacion.id',$id)
        ->select('mesas_votacion.id as id','mesas_votacion.numero_mesa as numero','mesas_votacion.descripcion as descripcion',
                'puestos_votacion.name as puesto')
        ->get();
        return view('mesasVotacion.view',['mesa'=>$mesa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MesaVotacion  $mesaVotacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $puestos = $this->modelPuestosVotacion::select('id','name')->get();
        $mesa = $this->model::join('puestos_votacion', 'mesas_votacion.puesto_votacion', '=', 'puestos_votacion.id')
        ->where('mesas_votacion.id',$id)
        ->select('mesas_votacion.id as id','mesas_votacion.numero_mesa as numero','mesas_votacion.descripcion as descripcion',
                'mesas_votacion.puesto_votacion as id_puesto','puestos_votacion.name as puesto')
        ->get();
        return view('mesasVotacion.edit',['mesa'=>$mesa,'puestos'=>$puestos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MesaVotacion  $mesaVotacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'inputNumberTable' => 'required|max:255',
            'inputDescript' => 'required|max:255',
            'selectPolling_post' => 'required|max:600'  
        ]);

        $mesa = $this->model::find($id);
        if (!$mesa) {
            Alert::error('MesaVotacion', 'No se ha encontrado la mesa solicitada.');
            return redirect()->route('mesas.index');
        }

        $mesa -> numero_mesa = $request->inputNumberTable;
        $mesa -> descripcion = $request->inputDescript;
        $mesa -> puesto_votacion = $request->selectPolling_post;
        $mesa -> save();

        Alert::success('MesaVotacion', 'Se ha actualizado la mesa de votacion con exito!');
        return redirect()->route('mesas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MesaVotacion  $mesaVotacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mesa = $this->model::find($id);
        if (!$mesa) {
            Alert::error('MesaVotacion', 'No se ha encontrado la mesa  solicitada.');
            return redirect()->route('mesas.index');
        }

        $mesa->delete();

        Alert::success('MesaVotacion', 'Se ha eliminado la mesa de votacion con exito.');
        return redirect()->route('mesas.index');
    }

    //Query data and send to the main datatable.
    public function tabla(Request $request)
    {  
        $mesas = $this->model::query();
        if(!empty($request->puesto)){$mesas->where('mesas_votacion.puesto_votacion', $request->puesto);}
        if(!empty($request->comuna)){
            $mesas->where('puestos_votacion.zone_type','Comuna')
                        ->where('barrios.comuna_id',$request->comuna);
        }
        if(!empty($request->barrio)){
            $mesas->where('puestos_votacion.zone_type','Comuna')
                        ->where('puestos_votacion.zone',$request->barrio);
        }
        if(!empty($request->corregimiento)){
            $mesas->where('puestos_votacion.zone_type','Corregimiento')
                        ->where('veredas.corregimiento_id',$request->corregimiento);
        }
        if(!empty($request->vereda)){
            $mesas->where('puestos_votacion.zone_type','Corregimiento')
                        ->where('puestos_votacion.zone',$request->vereda);
        }
        
        $mesas->join('puestos_votacion', 'mesas_votacion.puesto_votacion', '=', 'puestos_votacion.id')
            ->leftJoin('barrios', 'puestos_votacion.zone', '=', 'barrios.id')
            ->leftJoin('comunas','barrios.comuna_id','=','comunas.id')
            ->leftJoin('veredas', 'puestos_votacion.zone', '=', 'veredas.id')
            ->leftJoin('corregimientos','veredas.corregimiento_id','=','corregimientos.id')
            ->select('mesas_votacion.id as id','mesas_votacion.numero_mesa as numero','mesas_votacion.descripcion as descripcion',
                     'puestos_votacion.name as puesto',
                      DB::raw("CASE puestos_votacion.zone_type WHEN 'Comuna' THEN barrios.name WHEN 'Corregimiento' THEN veredas.name END as zona"))
            
            ->orderBy('mesas_votacion.id');

            return DataTables::eloquent($mesas)
            ->addColumn('acciones', function ($col) {
                $btn =  '<a href="'.route('mesas.show',['id'=>$col->id]).'" class="btn btn-outline-secondary" title="Ver "><i class="fa fa-eye"></i></a>';
                if (Auth::user()->hasRole('administrador')) {
                    $btn .= '<a href="'.route('mesas.edit',['id'=>$col->id]).'" class="btn btn-outline-primary m-2" title="Editar "><i class="fa fa-edit"></i></a>';
                    $btn .= '<a href="'.route('mesas.delete',['id'=>$col->id]).'" class="btn btn-outline-danger" title="Eliminar "><i class="fa fa-times"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);     
    }
}
