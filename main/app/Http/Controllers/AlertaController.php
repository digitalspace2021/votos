<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Formulario;
use App\Models\MatrizSeguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AlertaController extends Controller
{
    protected $formulario;
    protected $candidatos;
    protected $matriz;

    public function __construct()
    {
        $this->formulario = new Formulario();
        $this->candidatos = new Candidato();
        $this->matriz = new MatrizSeguimiento();
    }
    
    // Redirect main view
    public function index(){
        $comunas = DB::table('comunas')->select('id','name')->get();
        $barrios = DB::table('barrios')->select('id','name')->get();
        $candidatos = Candidato::select('id','name')->get();
        $corregimientos = DB::table('veredas')->select('id','name')->get();
        return view('alertas.general',['comunas'=>$comunas,'barrios'=>$barrios,'corregimientos'=>$corregimientos,'candidatos'=>$candidatos]);
    }

    public function getByPerson(){
        return view('alertas.byPersona');
    }

    //Obtain user information by ID
    public function getUserForm(Request $request){
        $cedula = $request->inputCedula;
        $ouput = null;
        $usersForm = $this->formulario::where('formularios.identificacion', $cedula)
        ->join('matriz_seguimiento','formularios.id','=','matriz_seguimiento.formulario_id')
        ->join('users', 'formularios.propietario_id', '=', 'users.id')
        ->select('matriz_seguimiento.id as id_matriz','formularios.id as id_form','formularios.*', 'users.name as referido',
                'matriz_seguimiento.fechas_cuatro as llamadas',
                'matriz_seguimiento.fechas_cinco as visitas',
        DB::raw('CASE
                    WHEN (matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                        matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                        matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                        matriz_seguimiento.respuesta_diez) <= 4 THEN "Rojo"
                    WHEN (matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                        matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                        matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                        matriz_seguimiento.respuesta_diez) >= 5 AND
                        (matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                        matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                        matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                        matriz_seguimiento.respuesta_diez) <= 9 THEN "Amarillo"
                    ELSE "Verde"
                END AS alerta'))
        ->get();

        if ($usersForm->isEmpty()) {
            $output = ["status"=>0,"msg"=>"La persona consultada no esta registrada"];
            return $output;
            
        }

        return $usersForm;
    }

    //Query data and send to the main datatable.
    public function tabla(Request $request)
    {  
        $seguimientos = MatrizSeguimiento::query();
        if(!empty($request->cedula)){$seguimientos->where('formularios.identificacion',$request->cedula);}
        if(!empty($request->nombre)){$seguimientos->where('formularios.nombre', 'LIKE', '%' . $request->nombre . '%');}
        if(!empty($request->color)){
            $color = $request->color;

            if ($color == "Rojo") {
                $seguimientos->where(function($query) {
                    $query->whereRaw('(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                    matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                    matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                    matriz_seguimiento.respuesta_diez) <= ?', [4]);
                });
            } elseif ($color == "Amarillo") {
                $seguimientos->where(function($query) {
                    $query->whereRaw('(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                    matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                    matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                    matriz_seguimiento.respuesta_diez) >= ?', [5])
                    ->whereRaw('(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                    matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                    matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                    matriz_seguimiento.respuesta_diez) <= ?', [9]);
                });
            } elseif ($color == "Verde") {
                $seguimientos->whereRaw('(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                matriz_seguimiento.respuesta_diez) = ?', [10]);
            }
        }
        
        $seguimientos->join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
            ->join('barrios', 'formularios.zona', '=', 'barrios.id')->join('comunas','barrios.comuna_id','=','comunas.id')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->join('candidatos','formularios.candidato_id','=','candidatos.id')
            ->select('matriz_seguimiento.id as id','matriz_seguimiento.formulario_id as id_formulario','formularios.identificacion as identificacion', 'formularios.nombre as nombre','users.name as creador',
                        'candidatos.name as candidato','formularios.email as email','formularios.direccion as direccion','formularios.telefono as telefono',
                        'matriz_seguimiento.respuesta_uno as res_uno', 'matriz_seguimiento.respuesta_dos as res_dos','matriz_seguimiento.respuesta_tres as res_tres',
                        'matriz_seguimiento.respuesta_cuatro as res_cuatro','matriz_seguimiento.respuesta_cinco as res_cinco','matriz_seguimiento.respuesta_seis as res_seis','matriz_seguimiento.respuesta_siete as res_siete',
                        'matriz_seguimiento.respuesta_ocho as res_ocho','matriz_seguimiento.respuesta_nueve as res_nueve','matriz_seguimiento.respuesta_diez as res_diez',
                        DB::raw('CASE
                                    WHEN (matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                                    matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                                    matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                                    matriz_seguimiento.respuesta_diez) <= 4 THEN "Rojo"
                                    WHEN (matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                                    matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                                    matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                                    matriz_seguimiento.respuesta_diez) >= 5 AND
                                        (matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                                        matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                                        matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                                        matriz_seguimiento.respuesta_diez) <= 9 THEN "Amarillo"
                                    ELSE "Verde"
                                END AS alerta'))
            ->orderBy('matriz_seguimiento.id');

            return DataTables::eloquent($seguimientos)
            ->addColumn('acciones', function ($col) {
                //$btn =  '<a href="'.route('matriz.view',['id'=>$col->id]).'" class="btn btn-outline-secondary" title="Ver "><i class="fa fa-eye"></i></a>';
                $btn='';
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);     
    }

    public function getAlert(){
        $usersAlert = $this->formulario::join('matriz_seguimiento', 'formularios.id', '=', 'matriz_seguimiento.formulario_id')
    ->join('users', 'formularios.propietario_id', '=', 'users.id')
    ->select('matriz_seguimiento.id as id_matriz','formularios.id as id_form','formularios.*', 'users.name as referido',
        DB::raw('CASE
            WHEN (SUM(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                        matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                        matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                        matriz_seguimiento.respuesta_diez)) <= 4 THEN "Rojo"
            ELSE "Amarillo"
        END AS alerta'))
    ->whereRaw('(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                matriz_seguimiento.respuesta_siete + matriz_seguimiento.respuesta_ocho + matriz_seguimiento.respuesta_nueve + 
                matriz_seguimiento.respuesta_diez) BETWEEN 0 AND 9')
    ->groupBy('formularios.id','matriz_seguimiento.id')
    ->orderBy('alerta', 'desc')
    ->get();

        return $usersAlert;
    }
}
