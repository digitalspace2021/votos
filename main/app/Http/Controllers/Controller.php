<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\String\Inflector\EnglishInflector;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model;
    protected $singular;
    protected $plural;
    protected $className;

    public function __construct($className = null)
    {
        $this->getConfig($className);
    }

    public function getConfig($class)
    {
        if (isset($class)) {
            $this->className = class_basename(get_class($class));
            $this->model = $class;
            $this->singular = strtolower($this->className);
            $inflector = new EnglishInflector();
            $this->plural = $inflector->pluralize($this->singular)[0];
        }
    }

    public function index()
    {
        return view(trans($this->plural) . ".index");
    }


    public function crear()
    {
        $puestos = DB::table('mesas_votacion AS mv')
            ->select(DB::raw("CONCAT('Puesto: ', COALESCE(pv.name, 'Sin información'), ', ', 
                CASE
                    WHEN pv.zone_type = 'Comuna' THEN CONCAT('Barrio: ', COALESCE(barrios.name, 'Sin información'))
                    WHEN pv.zone_type = 'Corregimiento' THEN CONCAT('Vereda: ', COALESCE(veredas.name, 'Sin información'))
                END, ', Mesa: ', COALESCE(mv.numero_mesa, 'Sin información')) AS puesto_nombre"))
            ->leftJoin('puestos_votacion AS pv', 'pv.id', '=', 'mv.puesto_votacion')
            ->leftJoin('barrios', function ($join) {
                $join->on('pv.zone', '=', 'barrios.id')
                    ->where('pv.zone_type', '=', 'Comuna');
            })
            ->leftJoin('veredas', function ($join) {
                $join->on('pv.zone', '=', 'veredas.id')
                    ->where('pv.zone_type', '=', 'Corregimiento');
            })
            ->get();

            $users = DB::table('users')->get();

        return view(trans($this->plural) . ".crear", compact('puestos', 'users'));
    }

    public function eliminar_confirmar(Request $request, $id)
    {
        $usuario = $this->model::find($id);
        if (!$usuario) {
            Alert::error("$this->className", 'No se ha encontrado el usuario solicitado.');
            return redirect()->route('usuarios');
        }

        if ($usuario->foto) {
            Storage::disk('public')->delete($usuario->foto);
        }

        $info = DB::table('info_users')->where('id', $usuario->info_id)->first();

        if ($info) {
            /* Call to undefined method stdClass::delete() */
            $info = DB::table('info_users')->where('id', $usuario->info_id)->delete();
        }

        $usuario->delete();


        Alert::success("$this->className", 'Se ha eliminado el usuario con exito.');
        return redirect()->route('usuarios');
    }
}
