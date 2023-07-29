<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Candidato;
use App\Models\Formulario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\isEmpty;

class ActividadController extends Controller
{
    protected $model;
    protected $candidatos;

    public function __construct()
    {
        $this->model = new Actividad();
        $this->candidatos = new Candidato();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('actividades.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actividades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $output = ['status'=>0,'msg'=>'Usted no se encuentra registrado, por favor comuniquese con el administrador del sistema'];
        $request->validate([
            'inputCedula' => 'required|numeric',
            'inputTitulo' => 'required',
            'inputFecha' => 'required',
            'inputDescript' => 'required',
            'inputEvidencia' => 'required|file',
        ]);
        $user = $this->validate_user($request->inputCedula);
        if($user){
            if ($request->hasFile('inputEvidencia')) {
                $archivo = $request->file('inputEvidencia');
                $nombre = $archivo->getClientOriginalName();
                $renombrado = time() . '_' . $nombre;
                $ruta = $archivo->storeAs('archivos', $renombrado, 'public');
    
                $actividad = $this->model;
                $actividad -> nombre_actividad = $request->inputTitulo;
                $actividad -> descripcion_actividad = $request->inputDescript;
                $actividad -> fecha_actividad = Carbon::parse($request->inputFecha)->toDateString(); 
                $actividad -> evidencia = $ruta;
                $actividad -> id_user = $user->id;
                $actividad -> save(); 
    
                //Alert::success('Actividades', 'Se ha registrado la actividad con exito!');
                return response()->json(['success' => 'Se registro la actividad exitosamente.', 'redirect' => auth()->check() ? route('actividad.index') : route('home')]);
            }
        }
        else{
            return response()->json(['error' => 'Usted no se encuentra registrado, por favor comuniquese con el administrador del sistema']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividad = $this->model::where('actividades.id',$id)
         ->join('users', 'actividades.id_user', '=', 'users.id')
            ->leftJoin('info_users', 'users.info_id', '=', 'info_users.id')
            ->leftJoin('users as referido', 'info_users.referido_id', '=', 'referido.id')
            ->select('actividades.fecha_actividad as fecha','actividades.nombre_actividad as titulo','actividades.descripcion_actividad as descripcion','actividades.evidencia as evidencia',
                    'users.identificacion as cedula','users.name as nombre','info_users.direccion as direccion','info_users.telefono as telefono','referido.name as referido')
            ->get();
        
        return view('actividades.view',['actividad'=>$actividad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividad = $this->model::where('actividades.id',$id)
         ->join('users', 'actividades.id_user', '=', 'users.id')
            ->leftJoin('info_users', 'users.info_id', '=', 'info_users.id')
            ->leftJoin('users as referido', 'info_users.referido_id', '=', 'referido.id')
            ->select('actividades.id as id','actividades.fecha_actividad as fecha','actividades.nombre_actividad as titulo','actividades.descripcion_actividad as descripcion','actividades.evidencia as evidencia',
                    'users.identificacion as cedula','users.name as nombre','info_users.direccion as direccion','info_users.telefono as telefono','referido.name as referido')
            ->get();
        
        return view('actividades.edit',['actividad'=>$actividad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'inputTitulo' => 'required',
            'inputFecha' => 'required',
            'inputDescript' => 'required'
        ]);

        $actividad = $this->model::find($id);
        if (!$actividad) {
            Alert::error('Actividad', 'No se ha encontrado la actividad solicitada.');
            return redirect()->route('actividad.index');
        }

        if ($request->hasFile('inputEvidencia')) {
            
            $rutaArchivo = 'public/'.$actividad->evidencia;
            $rutaArchivo = str_replace('/', '\\', $rutaArchivo);
    
            if (Storage::exists($rutaArchivo)) {
                Storage::delete($rutaArchivo);
            }
    
            // Subir el nuevo archivo
            $archivo = $request->file('inputEvidencia');
            $nombre = $archivo->getClientOriginalName();
            $renombrado = time() . '_' . $nombre;
            $ruta = $archivo->storeAs('archivos', $renombrado, 'public');
            
            $actividad -> evidencia = $ruta;
        }

        $actividad -> nombre_actividad = $request->inputTitulo;
        $actividad -> descripcion_actividad = $request->inputDescript;
        $actividad -> fecha_actividad = Carbon::parse($request->inputFecha)->toDateString(); 
        $actividad -> save(); 

        Alert::success('Actividad', 'Actividad Actualizada Exitosamente');
        return redirect()->route('actividad.index');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = $this->model::find($id);
            if (!$actividad) {
                Alert::error('Actividad', 'No se ha encontrado la actividad solicitada.');
                return redirect()->route('actividad.index');
            }
            
            $rutaArchivo = 'public/'.$actividad->evidencia;
            $rutaArchivo = str_replace('/', '\\', $rutaArchivo);
            
            if (Storage::exists($rutaArchivo)) {
                Storage::delete($rutaArchivo);
            }

            $actividad->delete();

            Alert::success('Actividad', 'Actividad Elimina Exitosamente');
            return redirect()->route('actividad.index');
    }

    //--------------------------------------------------
    public function validate_user($cedula){
        $user = User::where('identificacion', $cedula)->first();
        if($user == null){
            return false;
        }
        else{
            return $user;
        }
    }

    public function getUserInfo(Request $request){
        $output = ['status'=>0,'msg'=>'Usted no se encuentra registrado, por favor comuniquese con el administrador del sistema'];
        if($this->validate_user($request->cedula)){
            $info_user = User::select('users.foto as foto','users.identificacion as identificacion', 'users.name as nombre', 'info_users.direccion as direccion', 'info_users.telefono as telefono', 'referido.name as referido')
            ->leftJoin('info_users', 'users.info_id', '=', 'info_users.id')
            ->leftJoin('users as referido', 'info_users.referido_id', '=', 'referido.id')
            ->where('users.identificacion', $request->cedula)
            ->get();

            return $info_user;
        }
        else{
            return $output;
        }
    }

    public function getStatistic(Request $request){
        $output = ['status'=>0,'msg'=>'No se encuentra informacion del usuario solicitado'];
        if($this->validate_user($request->cedula)){
            $actividades = $this->model::selectRaw('users.name as nombre, actividades.estado as estado, COUNT(*) as cantidad')
            ->leftJoin('users', 'actividades.id_user', '=', 'users.id')
            ->leftJoin('info_users', 'users.info_id', '=', 'info_users.id')
            ->where('users.identificacion', $request->cedula)
            ->groupBy('users.name', 'actividades.estado')
            ->get();

            return $actividades;
        }
        else{
            return $output;
        }
    }
    public function getStatisticVotos(Request $request){
        $output = ['status'=>0,'msg'=>'No se encuentra informacion del candidato solicitado'];
        
            $votos = Formulario::selectRaw('users.name as nombre, COUNT(*) as cantidad')
            ->leftJoin('users', 'formularios.propietario_id', '=', 'users.id')
            ->where('formularios.candidato_id', $request->candidato)
            ->where('users.identificacion',"=",$request->cedula)
            ->groupBy('users.name')
            ->get();

            
        if(!$votos->isEmpty()){
            return $votos;
        }
        else{
            return $output;
        }
    }

    public function changeStatus($id,$status){
        if(!empty($id)){
            $actividad = $this->model::find($id);
            if (!$actividad) {
                Alert::error('Actividad', 'No se ha encontrado la actividad solicitada.');
                return redirect()->route('actividad.index');
            }
            if($status>=0 && $status<=1){
                $actividad -> estado = $status;
                $actividad -> save();

                if($status == 1){
                    Alert::success('Actividad', 'Actividad Aprovada');
                    return redirect()->route('actividad.index');
                }
                elseif($status == 0){
                    Alert::success('Actividad', 'Actividad Desaprovada');
                    return redirect()->route('actividad.index');
                }
            }
            else{
                Alert::error('Actividad', 'Estado incorrecto');
                return redirect()->route('actividad.index');
            }      
        }
    }

    public function tabla(Request $request){
        $actividades = $this->model::query();
        if(!empty($request->cedula)){$actividades->where('users.identificacion', $request->cedula );}
        if(!empty($request->nombre)){$actividades->where('users.name', 'LIKE', '%' . $request->nombre . '%');}
        if(!empty($request->fecha)){$actividades->where('actividades.fecha_actividad',Carbon::parse($request->fecha)->toDateString());}

        if(Auth::user()->hasRole('simple')){
            $actividades->where('actividades.estado',1);
            $actividades->where('actividades.id_user',Auth::user()->id);
        }

        $actividades->join('users', 'actividades.id_user', '=', 'users.id')
            ->join('info_users','users.info_id','=','info_users.id')
            ->select('actividades.id as id','actividades.fecha_actividad as fecha','actividades.descripcion_actividad as descripcion','actividades.evidencia as evidencia',
                    'users.identificacion','users.name as nombre','info_users.direccion as direccion','info_users.telefono as telefono','actividades.estado as estado',
                    DB::raw('(SELECT COUNT(*) FROM actividades AS sub JOIN users AS us ON sub.id_user = us.id where
                    us.identificacion = users.identificacion) AS cantidad'))
            ->groupBy('users.identificacion','actividades.id');

            return DataTables::eloquent($actividades)
            ->addColumn('acciones', function ($col) {
                $btn =  '<a href="'.route('actividad.show',['id'=>$col->id]).'" class="btn btn-outline-secondary" title="Ver "><i class="fa fa-eye"></i></a>';
                $btn .= '<a href="'.route('actividad.edit',['id'=>$col->id]).'" class="btn btn-outline-primary m-2" title="Editar "><i class="fa fa-edit"></i></a>';
                if (Auth::user()->hasRole('administrador')) {  
                    $btn .= '<a href="'.route('actividad.delete',['id'=>$col->id]).'"class="btn btn-outline-dark" title="Eliminar"><i class="fa fa-times"></i></a>';
                    if($col->estado==1){
                        $btn .= '<a href="'.route('actividad.status',['id'=>$col->id,'status'=>0]).'"class="btn btn-outline-dark m-2"  title="Desaprobar"><i class="fa fa-ban"></i></a>';
                    }
                    else{
                        $btn .= '<a href="'.route('actividad.status',['id'=>$col->id,'status'=>1]).'"class="btn btn-outline-success m-2"  title="Aprobar"><i class="fa fa-check"></i></a>';
                    }
                }
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);     
    }

    public function statisticsIndex(){
        $can = $this->candidatos::select('id', 'name')->get();
        return view('statitics.byPersona',['candidatos'=>$can]);
    }
}
