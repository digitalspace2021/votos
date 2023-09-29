<?php

namespace App\Http\Services\Problems;

use App\Models\Formulario;
use App\Models\PreFormulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovedInfoService
{
    /**
     * Create a new Formulario instance with the given PreFormulario data and save it to the database.
     *
     * @param PreFormulario $pre_formulario The PreFormulario instance to create the Formulario from.
     * @return Formulario The newly created Formulario instance.
     */
    public function approvedInfo(PreFormulario $pre_formulario): Formulario
    {
        DB::beginTransaction();

        $formulario = Formulario::create([
            'propietario_id' => $pre_formulario->propietario_id,
            'candidato_id' => $pre_formulario->candidato_id,
            'identificacion' => $pre_formulario->identificacion,
            'nombre' => $pre_formulario->nombre,
            'apellido' => $pre_formulario->apellido,
            'telefono' => $pre_formulario->telefono,
            'direccion' => $pre_formulario->direccion,
            'puesto_votacion' => $pre_formulario->puesto_votacion,
            'mesa' => $pre_formulario->mesa,
            'genero' => $pre_formulario->genero,
            'email' => $pre_formulario->email ?? '',
            'mensaje' => $pre_formulario->mensaje,
            'tipo_zona' => $pre_formulario->tipo_zona,
            'zona' => $pre_formulario->zona,
        ]);

        $formulario->candidatos()->sync($pre_formulario->candidatos->pluck('id')->toArray());

        DB::commit();

        return $formulario;
    }
}
