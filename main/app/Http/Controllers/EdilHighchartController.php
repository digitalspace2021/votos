<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Formulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EdilHighchartController extends Controller
{
    public function handleChart($edil=null,$zona=null,$zona_id=null)
    {
        //veredas y barrios
        $veredas = DB::table('veredas')->select('id','name')->get();
        $barrios = DB::table('barrios')->select('id','name')->get();

        $ediles = DB::table('usuarios_ediles')
            ->where('rol', 'Edil')
            ->select('id', 'nombres', 'apellidos')
            ->get();

        $DataUsers = (object)collect([]);
        $DataComunas = (object)collect([]);
        $DataCorregimientos = (object)collect([]);
        $dataVeredas = (object)collect([]);
        $dataBarrios = (object)collect([]);

        if (!$edil) {
            return view('problems.edils-statics', compact('DataCorregimientos', 'DataComunas', 'DataUsers', 'ediles', 'edil','dataVeredas','dataBarrios'));
        }

        /****************************************************************************************************************************************** */
        $DataCorregimientos = Formulario::select('corregimientos.name as drilldown', 'corregimientos.name as name', DB::raw("COUNT(formularios.id) as y"), 'formularios.tipo_zona')
            ->join('veredas', 'formularios.zona', '=', 'veredas.id')
            ->join('corregimientos', 'veredas.corregimiento_id', '=', 'corregimientos.id')
            /* ->join('users', 'users.id', '=', 'formularios.propietario_id') */
            ->join('ediles', 'ediles.formulario_id', '=', 'formularios.id')
            ->where('formularios.tipo_zona', 'Corregimiento')
            ->where('formularios.estado', true)
            ->where('ediles.edil_id', $edil)
            ->groupBy('formularios.tipo_zona', 'corregimientos.name')
            ->get();
        /****************************************************************************************************************************************** */
        $DataComunas = Formulario::select('comunas.name as drilldown', 'comunas.name as name', DB::raw("COUNT(formularios.id) as y"), 'formularios.tipo_zona')
            ->join('barrios', 'formularios.zona', '=', 'barrios.id')
            ->join('comunas', 'barrios.comuna_id', '=', 'comunas.id')
            /* ->join('users', 'users.id', '=', 'formularios.propietario_id') */
            ->join('ediles', 'ediles.formulario_id', '=', 'formularios.id')
            ->where('formularios.tipo_zona', 'Comuna')
            ->where('formularios.estado', true)
            ->where('ediles.edil_id', $edil)
            ->groupBy('formularios.tipo_zona', 'comunas.name')
            ->get();
        /****************************************************************************************************************************************** */
        /* $DataUsers = Formulario::select('users.name as drilldown', 'users.name as name',  DB::raw("COUNT(formularios.id) as y"))
            ->join('users', 'users.id', 'formularios.propietario_id')
            ->where(function ($query) use ($candidato) {
                $query->where('candidato_id', $candidato)
                    ->orWhereNull('candidato_id');
            })
            ->where('formularios.estado', true)
            ->groupBy('users.name')
            ->get(); */


        if($zona == 'ver'){
            $dataVeredas = Formulario::select('veredas.name as drilldown', 'veredas.name as name', DB::raw("COUNT(formularios.id) as y"), 'formularios.tipo_zona')
            ->join('veredas', 'formularios.zona', '=', 'veredas.id')
            ->join('corregimientos', 'veredas.corregimiento_id', '=', 'corregimientos.id')
            /* ->join('users', 'users.id', '=', 'formularios.propietario_id') */
            ->join('ediles', 'ediles.formulario_id', '=', 'formularios.id')
            ->where('formularios.tipo_zona', 'Corregimiento')
            ->where('veredas.id',$zona_id)
            ->where('formularios.estado', true)
            ->where('ediles.edil_id', $edil)
            ->groupBy('formularios.tipo_zona', 'veredas.name')
            ->get();
        }

        if($zona == 'bar'){
            $dataBarrios = Formulario::select('barrios.name as drilldown', 'barrios.name as name', DB::raw("COUNT(formularios.id) as y"), 'formularios.tipo_zona')
            ->join('barrios', 'formularios.zona', '=', 'barrios.id')
            ->join('comunas', 'barrios.comuna_id', '=', 'comunas.id')
            /* ->join('users', 'users.id', '=', 'formularios.propietario_id') */
            ->join('ediles', 'ediles.formulario_id', '=', 'formularios.id')
            ->where('formularios.tipo_zona', 'Comuna')
            ->where('barrios.id',$zona_id)
            ->where('formularios.estado', true)
            ->where('ediles.edil_id', $edil)
            ->groupBy('formularios.tipo_zona', 'barrios.name')
            ->get();
        }


        return view('problems.edils-statics', compact('DataCorregimientos', 'DataComunas', 'DataUsers', 'ediles', 'edil','veredas','barrios','dataVeredas','dataBarrios'));
    }
}
