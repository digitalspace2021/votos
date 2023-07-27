<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilityController extends Controller
{

    public function getVeredasAndComunas()
    {

        if (request()->get('type') == 'Corregimiento') {
            if (request()->get('id')) {
                return response()->json(DB::table('veredas')->where('id', request()->get('id'))->select('name as text', 'id')->get());
            }
            if (request()->get('search', null)) {
                return response()->json(DB::table('veredas')->select('name as text', 'id')->where('name', 'Like', "%" . request()->get('search') . "%")->get());
            }
            return response()->json(DB::table('veredas')->select('name as text', 'id')->get());
        }

        if (request()->get('type') == 'Comuna') {
            if (request()->get('id')) {
                return response()->json(DB::table('barrios')->where('id', request()->get('id'))->select('name as text', 'id')->get());
            }
            if (request()->get('search', null)) {
                return response()->json(DB::table('barrios')->select('name as text', 'id')->where('name', 'Like', "%" . request()->get('search') . "%")->get());
            }
            return response()->json(DB::table('barrios')->select('name as text', 'id')->get());
        }


        // if (request()->get('id')) {
        //     return response()->json(DB::table('barrios')->where('id', request()->get('id'))->select('name as text', 'id')->get());
        // }
        // return response()->json(DB::table('barrios')->select('name as text', 'id')->get());
    }

    public function getMesas(Request $request)
    {
        $mesas = DB::table('mesas_votacion')->where('puesto_votacion', $request->puesto_id)->get(['numero_mesa']);

        return response()->json($mesas);
    }
}
