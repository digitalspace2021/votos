<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilityController extends Controller
{

    public function getVeredasAndComunas()
    {
        if (request()->get('type') == 'Vereda') {
            if (request()->get('id')) {
                return response()->json(DB::table('veredas')->where('id', request()->get('id'))->select('name as text', 'id')->get());
            }
            return response()->json(DB::table('veredas')->select('name as text', 'id')->get());
        }
        if (request()->get('id')) {
            return response()->json(DB::table('barrios')->where('id', request()->get('id'))->select('name as text', 'id')->get());
        }
        return response()->json(DB::table('barrios')->select('name as text', 'id')->get());
    }
}
