<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighchartController extends Controller
{
    public function handleChart($candidato = null)
    {

        $DataUsers = (object)collect([]);
        $DataComunas = (object)collect([]);
        $DataCorregimientos = (object)collect([]);

        if (!$candidato) {
            return view('statitics.bybarrios', compact('DataCorregimientos', 'DataComunas', 'DataUsers'));
        }
        /****************************************************************************************************************************************** */
        $DataCorregimientos = Formulario::select('corregimientos.name as drilldown', 'corregimientos.name as name', DB::raw("COUNT(formularios.id) as y"), 'formularios.tipo_zona')
            ->join('veredas', 'formularios.zona', '=', 'veredas.id')
            ->join('corregimientos', 'veredas.corregimiento_id', '=', 'corregimientos.id')
            ->join('users', 'users.id', '=', 'formularios.propietario_id')
            ->where('formularios.tipo_zona', 'Corregimiento')
            ->where('candidato_id', $candidato)
            ->groupBy('formularios.tipo_zona', 'corregimientos.name')
            ->get();
        /****************************************************************************************************************************************** */
        $DataComunas = Formulario::select('comunas.name as drilldown', 'comunas.name as name', DB::raw("COUNT(formularios.id) as y"), 'formularios.tipo_zona')
            ->join('barrios', 'formularios.zona', '=', 'barrios.id')
            ->join('comunas', 'barrios.comuna_id', '=', 'comunas.id')
            ->join('users', 'users.id', '=', 'formularios.propietario_id')
            ->where('formularios.tipo_zona', 'Comuna')
            ->where('candidato_id', $candidato)
            ->groupBy('formularios.tipo_zona', 'comunas.name')
            ->get();
        /****************************************************************************************************************************************** */
        $DataUsers = Formulario::select('users.name as drilldown', 'users.name as name',  DB::raw("COUNT(formularios.id) as y"))
            ->join('users', 'users.id', 'formularios.propietario_id')
            ->where('candidato_id', $candidato)
            ->groupBy('users.name')
            ->get();

        return view('statitics.bybarrios', compact('DataCorregimientos', 'DataComunas', 'DataUsers'));
    }
}
