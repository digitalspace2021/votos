<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ActividadController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Actividad();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                return response()->json(['success' => 'Se registro la actividad exitosamente.', 'redirect' => route('actividad.create')]);
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
    public function show(Actividad $actividad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividad $actividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actividad $actividad)
    {
        //
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
            $info_user = User::select('users.identificacion as identificacion', 'users.name as nombre', 'info_users.direccion as direccion', 'info_users.telefono as telefono', 'referido.name as referido')
            ->join('info_users', 'users.info_id', '=', 'info_users.id')
            ->join('users as referido', 'info_users.referido_id', '=', 'referido.id')
            ->where('users.identificacion', $request->cedula)
            ->get();


            return $info_user;
        }
        else{
            return $output;
        }
    }
}
