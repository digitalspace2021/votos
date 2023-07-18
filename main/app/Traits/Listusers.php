<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Listusers
{
    public function lista_usuarios(Request $request)
    {
        $usuarios = $this->model::select(['id', 'name']);
        if ($busqueda = $request->search) {
            $usuarios = $usuarios->whereRaw('LOWER(name) like "%' . strtolower($busqueda) . '%"');
        }

        if(env('USERS_TEST')){
            $usuarios = $usuarios->where(function ($query){
                $query->where('name', '!=', 'Admin')
                    ->where('name', '!=', 'simple');
            });
        }

        return $usuarios->get(10)->map(function ($usuario) {
            return [
                "id" => $usuario->id,
                "text" => $usuario->name
            ];
        });
    }

    public function lista_candidatos(Request $request)
    {
        $usuarios = $this->model::select(['id', 'name']);
        if ($busqueda = $request->search) {
            $usuarios = $usuarios->whereRaw('LOWER(name) like "%' . strtolower($busqueda) . '%"');
        }

        return $usuarios->get(10)->map(function ($usuario) {
            return [
                "id" => $usuario->id,
                "text" => $usuario->name
            ];
        });
    }
}
