<?php

namespace App\Http\Resources\Votos;

use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'nombre_completo' => "$this->nombre $this->apellido",
            'identificacion' => $this->identificacion,
            'direccion' => $this->direccion,
            'ubicacion' => $this->ubicacion,
            'registrador' => $this->registrador,
            'fecha_creacion' => $this->created_at,
        ];
    }
}
