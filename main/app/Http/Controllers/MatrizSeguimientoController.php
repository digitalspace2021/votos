<?php 
namespace App\Http\Controllers;

use App\Models\Candidato;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Formulario;
use App\Models\MatrizSeguimiento;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MatrizSeguimientoController extends Controller
{

    protected $formulario;
    protected $candidatos;
   
    protected $model;
    public function __construct(MatrizSeguimiento $model)
    {
        $this->formulario = new Formulario();
        $this->candidatos = new Candidato();
        
        $this->model = $model;
    }

    public function index(){
        $barrios = DB::table('barrios')->select('id','name')->get();
        $candidatos = Candidato::select('id','name')->get();
        $corregimientos = DB::table('veredas')->select('id','name')->get();
        return view('matrizSeguimiento.index',['barrios'=>$barrios,'corregimientos'=>$corregimientos,'candidatos'=>$candidatos]);
    }

    public function view($id){
        
        if(!empty($id)){
            $seguimientos = MatrizSeguimiento::join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->select('matriz_seguimiento.*', 'formularios.nombre as usuario', 'users.name as referido',
                    'formularios.identificacion','formularios.direccion','formularios.telefono')
            ->where('matriz_seguimiento.id', $id) 
            ->get();
        }
        //dd($seguimientos);
        return view('matrizSeguimiento.view',['seguimientos' => $seguimientos]);
    }

    public function getUserForm(Request $request){
        $id = $request->id;
        $ouput = null;
        $usersForm = Formulario::where('formularios.identificacion', $id)
        ->join('users', 'formularios.propietario_id', '=', 'users.id')
        ->select('formularios.*', 'users.name as referido')
        ->get();

        if ($usersForm->isEmpty()) {
            $output = ["status"=>0,"msg"=>"La persona consultada no esta registrada"];
            return $output;
            
        }

        return $usersForm;
    }

    public function create(){
        return view('matrizSeguimiento.create');
    }
    public function store(Request $request){
        $request->validate([
            'ID' => 'required',
            'name' => 'required|max:255',
            'referred' => 'required',
            'pregunta1' => 'required',
            'pregunta2' => 'required',
            'pregunta3' => 'required',
            'pregunta4' => 'required',
            'pregunta5' => 'required',
            'pregunta6' => 'required',
        ]);

        $matriz= new MatrizSeguimiento();
        $matriz->formulario_id = $request->formulario_id;
        $matriz->respuesta_uno = $request->pregunta1;
        $matriz->respuesta_dos = $request->pregunta2;
        $matriz->respuesta_tres = $request->pregunta3;
        $matriz->respuesta_cuatro = $request->pregunta4;
        $matriz->fechas_cuatro = $request->datesInputCall ? json_encode($request->datesInputCall) : NULL;
        $matriz->respuesta_cinco = $request->pregunta5;
        $matriz->fechas_cinco = $request->datesInputVisit ? json_encode($request->datesInputVisit) : NULL;
        $matriz->respuesta_seis = $request->pregunta6;
        $matriz->save();

        Alert::success('Seguimiento', 'Se ha creado el registro con exito!');
        return redirect()->route('matriz');
    }

    public function statisticsIndex(){
        $can = $this->candidatos::select('id', 'name')->get();
        return view('statitics.matrizSeguimiento',['candidatos'=>$can]);
    }

    public function getStatistics(Request $request){
        $id = $request->candidato;
        if(!empty($id)){
            $seguimientos = MatrizSeguimiento::join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->select('matriz_seguimiento.*', 'formularios.nombre as usuario', 'users.name as referido')
            ->where('formularios.candidato_id', $id) 
            ->get();
        
        return $seguimientos;
        }
        
    }
   public function edit($id){
    if(!empty($id)){
        $seguimientos = MatrizSeguimiento::join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
        ->join('users', 'formularios.propietario_id', '=', 'users.id')
        ->select('matriz_seguimiento.*', 'formularios.nombre as usuario', 'users.name as referido',
                'formularios.identificacion','formularios.direccion','formularios.telefono')
        ->where('matriz_seguimiento.id', $id) 
        ->get();
    }
    return view('matrizSeguimiento.edit',['seguimientos' => $seguimientos]); 
   }

   public function update(Request $request,$id){
        $request->validate([
            'ID' => 'required',
            'name' => 'required|max:255',
            'referred' => 'required',
            'pregunta1' => 'required',
            'pregunta2' => 'required',
            'pregunta3' => 'required',
            'pregunta4' => 'required',
            'pregunta5' => 'required',
            'pregunta6' => 'required',
        ]);
        $matriz = $this->model::find($id);
        if (!$matriz) {
            Alert::error('Seguimiento', 'No se ha encontrado el seguimiento solicitado.');
            return redirect()->route('matriz');
        }
        
        $matriz->respuesta_uno = $request->pregunta1;
        $matriz->respuesta_dos = $request->pregunta2;
        $matriz->respuesta_tres = $request->pregunta3;
        $matriz->respuesta_cuatro = $request->pregunta4;
        $matriz->fechas_cuatro = $request->datesInputCall ? json_encode($request->datesInputCall) : NULL;
        $matriz->respuesta_cinco = $request->pregunta5;
        $matriz->fechas_cinco = $request->datesInputVisit ? json_encode($request->datesInputVisit) : NULL;
        $matriz->respuesta_seis = $request->pregunta6;
        $matriz->save();

        Alert::success('Seguimiento', 'Se ha actualizado el seguimiento con exito!');
        return redirect()->route('matriz');
   }

    public function delete($id){
        $matriz = $this->model::find($id);
        if (!$matriz) {
            Alert::error('Seguimiento', 'No se ha encontrado el seguimiento solicitado.');
            return redirect()->route('matriz');
        }

        $matriz->delete();

        Alert::success('Seguimiento', 'Se ha eliminado el seguimiento con exito.');
        return redirect()->route('matriz');
    }

    public function tabla(Request $request)
    {  
        $seguimientos = MatrizSeguimiento::query();
        if(!empty($request->candidato)){$seguimientos->where('formularios.candidato_id',$request->candidato);}
        if(!empty($request->pregunta)){
            if($request->pregunta == 1){ $seguimientos->where('matriz_seguimiento.respuesta_uno',1);}
            if($request->pregunta == 2){ $seguimientos->where('matriz_seguimiento.respuesta_dos',1);}
            if($request->pregunta == 3){ $seguimientos->where('matriz_seguimiento.respuesta_tres',1);}
            if($request->pregunta == 4){ $seguimientos->where('matriz_seguimiento.respuesta_cuatro',1);}
            if($request->pregunta == 5){ $seguimientos->where('matriz_seguimiento.respuesta_cinco',1);}
            if($request->pregunta == 6){ $seguimientos->where('matriz_seguimiento.respuesta_seis',1);}
        }
        if(!empty($request->cedula)){$seguimientos->where('formularios.identificacion',$request->cedula);}
        if(!empty($request->barrio)){
            $seguimientos->where('formularios.tipo_zona','comuna')
                        ->where('formularios.zona',$request->barrio);
        }
        if(!empty($request->corregimiento)){
            $seguimientos->where('formularios.tipo_zona','corregimiento')
                        ->where('formularios.zona',$request->corregimiento);
        }
        $seguimientos->join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->join('candidatos','formularios.candidato_id','=','candidatos.id')
            ->select('matriz_seguimiento.id as id','matriz_seguimiento.formulario_id as id_formulario','formularios.identificacion as identificacion', 'formularios.nombre as nombre','users.name as creador',
                        'candidatos.name as candidato','formularios.email as email','formularios.direccion as direccion','formularios.telefono as telefono',
                        'matriz_seguimiento.respuesta_uno as res_uno', 'matriz_seguimiento.respuesta_dos as res_dos','matriz_seguimiento.respuesta_tres as res_tres',
                        'matriz_seguimiento.respuesta_cuatro as res_cuatro','matriz_seguimiento.respuesta_cinco as res_cinco','matriz_seguimiento.respuesta_seis as res_seis')
            
            ->orderBy('matriz_seguimiento.id');

            return DataTables::eloquent($seguimientos)
            ->addColumn('acciones', function ($col) {
                $btn =  '<a href="'.route('matriz.view',['id'=>$col->id]).'" class="btn btn-outline-secondary" title="Ver "><i class="fa fa-eye"></i></a>';
                if (Auth::user()->hasRole('administrador')) {
                    $btn .= '<a href="'.route('matriz.edit',['id'=>$col->id]).'" class="btn btn-outline-primary m-2" title="Editar "><i class="fa fa-edit"></i></a>';
                    $btn .= '<a href="'.route('matriz.delete',['id'=>$col->id]).'" class="btn btn-outline-danger" title="Eliminar "><i class="fa fa-times"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
            
        
    }

}
