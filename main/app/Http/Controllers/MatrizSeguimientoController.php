<?php 
namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Formulario;
use App\Models\MatrizSeguimiento;
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
    
    // Redirect main view
    public function index(){
        $comunas = DB::table('comunas')->select('id','name')->get();
        $barrios = DB::table('barrios')->select('id','name')->get();
        $candidatos = Candidato::select('id','name')->get();
        $corregimientos = DB::table('veredas')->select('id','name')->get();
        return view('matrizSeguimiento.index',['comunas'=>$comunas,'barrios'=>$barrios,'corregimientos'=>$corregimientos,'candidatos'=>$candidatos]);
    }

    //View information
    public function view($id){ 
        if(!empty($id)){
            $seguimientos = MatrizSeguimiento::join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->select('matriz_seguimiento.*', 'formularios.nombre as usuario', 'users.name as referido',
                    'formularios.identificacion','formularios.direccion','formularios.telefono')
            ->where('matriz_seguimiento.id', $id) 
            ->get();
        }
        return view('matrizSeguimiento.view',['seguimientos' => $seguimientos]);
    }

    //Obtain user information by ID
    public function getUserForm(Request $request){
        $id = $request->id;
        $ouput = null;
        $usersForm = Formulario::where('formularios.identificacion', $id)
        ->join('users', 'formularios.propietario_id', '=', 'users.id')
        ->select('formularios.id as id_form','formularios.*', 'users.name as referido')
        ->get();

        if ($usersForm->isEmpty()) {
            $output = ["status"=>0,"msg"=>"La persona consultada no esta registrada"];
            return $output;
            
        }

        return $usersForm;
    }

    //Redirect to create view
    public function create(){
        return view('matrizSeguimiento.create');
    }

    //Save data in the DB
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
            'pregunta7' => 'required',
        ]);

        $matriz= new MatrizSeguimiento();
        $matriz->formulario_id = $request->formulario_id;
        $matriz->respuesta_uno = $request->pregunta1;
        $matriz->respuesta_dos = $request->pregunta2;
        $matriz->respuesta_tres = $request->pregunta3;
        $matriz->respuesta_cuatro = $request->pregunta4;
        $matriz->fechas_cuatro = ($request->datesInputCall && $request->pregunta4 == 1) ? json_encode($request->datesInputCall) : NULL;
        $matriz->obs_cuatro = ($request->obsInputCall && $request->pregunta4 == 1) ? json_encode($request->obsInputCall) : NULL;
        $matriz->respuesta_cinco = $request->pregunta5;
        $matriz->fechas_cinco = ($request->datesInputVisit && $request->pregunta5 == 1) ? json_encode($request->datesInputVisit) : NULL;
        $matriz->obs_cinco = ($request->obsInputVisit && $request->pregunta5 == 1) ? json_encode($request->obsInputVisit) : NULL;
        $matriz->respuesta_seis = $request->pregunta6;
        $matriz->respuesta_siete = $request->pregunta7;
        $matriz->fechas_siete = ($request->datesInputStake && $request->pregunta7 == 1) ? json_encode($request->datesInputStake) : NULL;
        $matriz->save();

        Alert::success('Seguimiento', 'Se ha creado el registro con exito!');
        return redirect()->route('matriz');
    }

    //Redirect to statistics view
    public function statisticsIndex(){
        $can = $this->candidatos::select('id', 'name')->get();
        return view('statitics.matrizSeguimiento',['candidatos'=>$can]);
    }

    //Query to generate statistics
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

    //Redirect and consult information to update
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

    public function editQuestion(Request $request){
        $id = $request->input('id_matriz');
        $pregunta = $request->input('pregunta');
        
        if(!empty($id)){
            $seguimiento = MatrizSeguimiento::join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
            ->select('matriz_seguimiento.*', 'formularios.nombre as usuario',
                    'formularios.identificacion','formularios.direccion','formularios.telefono')
            ->where('matriz_seguimiento.id', $id) 
            ->get();
        }
        return view('matrizSeguimiento.byQuestion',['seguimientos' => $seguimiento,'pregunta'=>$pregunta]); 
    }

    //update Question
    public function updateQuestion(Request $request,$id){
        
        $matriz = $this->model::find($id);
        if (!$matriz) {
            Alert::error('Seguimiento', 'No se ha encontrado el seguimiento solicitado.');
            return redirect()->route('matriz');
        }
        
        if($request->pregunta == 4){
            
            $matriz->respuesta_cuatro = $request->pregunta4;
            $matriz->fechas_cuatro = ($request->datesInputCall && $request->pregunta4 == 1) ? json_encode($request->datesInputCall) : NULL;
            
        }

        if($request->pregunta == 5){
            $matriz->respuesta_cinco = $request->pregunta5;
            $matriz->fechas_cinco = ($request->datesInputVisit && $request->pregunta5 == 1) ? json_encode($request->datesInputVisit) : NULL;
            
        }
       
        $matriz->save();

        Alert::success('Seguimiento', 'Se ha actualizado el seguimiento con exito!');
        return redirect()->route('alerta.index');
   }

    //Update data in the DB
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
            'pregunta7' => 'required',
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
        $matriz->fechas_cuatro = ($request->datesInputCall && $request->pregunta4 == 1) ? json_encode($request->datesInputCall) : NULL;
        $matriz->obs_cuatro = ($request->obsInputCall && $request->pregunta4 == 1) ? json_encode($request->obsInputCall) : NULL;
        $matriz->respuesta_cinco = $request->pregunta5;
        $matriz->fechas_cinco = ($request->datesInputVisit && $request->pregunta5 == 1) ? json_encode($request->datesInputVisit) : NULL;
        $matriz->obs_cinco = ($request->obsInputVisit && $request->pregunta5 == 1) ? json_encode($request->obsInputVisit) : NULL;
        $matriz->respuesta_seis = $request->pregunta6;
        $matriz->respuesta_siete = $request->pregunta7;
        $matriz->fechas_siete = ($request->datesInputStake && $request->pregunta7 == 1) ? json_encode($request->datesInputStake) : NULL;
        $matriz->save();

        Alert::success('Seguimiento', 'Se ha actualizado el seguimiento con exito!');
        return redirect()->route('matriz');
   }

    //Delete data in the DB
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

    //Query data and send to the main datatable.
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
            if($request->pregunta == 7){ $seguimientos->where('matriz_seguimiento.respuesta_siete',1);}
        }
        if(!empty($request->cedula)){$seguimientos->where('formularios.identificacion',$request->cedula);}
        if(!empty($request->comuna)){
            $seguimientos->where('formularios.tipo_zona','comuna')
                        ->where('barrios.comuna_id',$request->comuna);
        }
        if(!empty($request->barrio)){
            $seguimientos->where('formularios.tipo_zona','comuna')
                        ->where('formularios.zona',$request->barrio);
        }
        if(!empty($request->corregimiento)){
            $seguimientos->where('formularios.tipo_zona','corregimiento')
                        ->where('formularios.zona',$request->corregimiento);
        }
        $seguimientos->join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
            ->join('barrios', 'formularios.zona', '=', 'barrios.id')->join('comunas','barrios.comuna_id','=','comunas.id')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->join('candidatos','formularios.candidato_id','=','candidatos.id')
            ->select('matriz_seguimiento.id as id','matriz_seguimiento.formulario_id as id_formulario','formularios.identificacion as identificacion', 'formularios.nombre as nombre','users.name as creador',
                        'candidatos.name as candidato','formularios.email as email','formularios.direccion as direccion','formularios.telefono as telefono',
                        'matriz_seguimiento.respuesta_uno as res_uno', 'matriz_seguimiento.respuesta_dos as res_dos','matriz_seguimiento.respuesta_tres as res_tres',
                        'matriz_seguimiento.respuesta_cuatro as res_cuatro','matriz_seguimiento.respuesta_cinco as res_cinco','matriz_seguimiento.respuesta_seis as res_seis','matriz_seguimiento.respuesta_siete as res_siete')
            
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
