<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
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
        return view(trans($this->plural) . ".crear");
    }

    public function eliminar_confirmar(Request $request, $id)
    {
        $usuario = $this->model::find($id);
        if (!$usuario) {
            Alert::error("$this->className", 'No se ha encontrado el usuario solicitado.');
            return redirect()->route('usuarios');
        }

        $usuario->delete();

        Alert::success("$this->className", 'Se ha eliminado el usuario con exito.');
        return redirect()->route('usuarios');
    }
}
