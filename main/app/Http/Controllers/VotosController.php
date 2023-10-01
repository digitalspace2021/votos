<?php

namespace App\Http\Controllers;

use App\Http\Resources\Votos\FormResource;
use App\Models\Formulario;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotosController extends Controller
{
    protected $resp;

    public function __construct()
    {
        $this->resp = new ResponseService();
    }

    public function index()
    {
        return view('Votos.index');
    }

    public function getAll()
    {
    }

    public function create(string $form_id = null)
    {
        return view('votos.create');
    }

    public function getFormIdentification(Request $request)
    {
        $form = Formulario::select('formularios.id','formularios.identificacion', 'formularios.created_at', 'direccion', 'tipo_zona', 'nombre', 'apellido', 'zona', 'users.name as registrador')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->where('formularios.identificacion', $request->identificacion)
            ->where('estado', true)
            ->first();
        $ubication = null;

        if (!$form) {
            return $this->resp->response('error', 'No se encontro el formulario', 404);
        }

        if ($form->tipo_zona == 'Comuna') {
            $ubication = DB::table('comunas')
                ->join('barrios', 'comunas.id', '=', 'barrios.comuna_id')
                ->where('barrios.id', $form->zona)
                ->select('comunas.name as general', 'barrios.name as location')
                ->first();
        } else {
            $ubication = DB::table('corregimientos')
                ->join('corregimientos', 'veredas.corregimiento_id', '=', 'corregimientos.id')
                ->where('veredas.id', $form->zona)
                ->select('corregimientos.name as general', 'veredas.name as location')
                ->first();
        }

        $form->ubicacion = "$ubication->general - $ubication->location";

        return new FormResource($form);
    }
}
