<?php

namespace App\Imports;

use App\Models\Formulario;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FormImport implements ToModel,  WithValidation, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        // try {

        if ($this->validateIdNumber($row['identificacion'])) {

            return  new Formulario([
                'propietario_id' => request()->get('creador_id'),
                'candidato_id' => request()->get('candidato_id'),
                'nombre' => $row['nombres'],
                'apellido' => $row['apellidos'],
                'email' => $row['email'],
                'telefono' => $row['telefono'],
                'genero' => $row['genero'],
                'direccion' => $row['direccion'],
                'tipo_zona' => request()->get('tipo_zona'),
                'zona' => request()->get('zona'),
                'puesto_votacion' => $row['puesto_votacion'],
                'mensaje' => $row['mensaje'],
                'identificacion' => $row['identificacion']
            ]);
        }
        // } catch (\Exception $th) {
        //     return null;
        // }
    }


    public function validateIdNumber($identificacion): bool
    {
        if (Formulario::firstWhere('identificacion', $identificacion)) {
            return false;
        }
        return true;
    }


    public function rules(): array
    {
        return [
            'nombres' => [
                'required',
                'string',
            ],
            // 'creador_id' => [
            //     'required',
            //     'string',
            // ],
            'identificacion' => [
                'required',
            ],
            // 'candidato_id' => [
            //     'required',
            //     'string',
            // ],
            'mensaje' => [
                'required',
                'string',
            ],
            'puesto_votacion' => [
                'required',
                'string',
            ],
            // 'zona' => [
            //     'required',
            //     'string',
            // ],
            'direccion' => [
                'required',
                'string',
            ],
            'genero' => [
                'required',
                'string',
            ],
            'telefono' => [
                'required',
            ],
            'email' => [
                'required',
                'string',
            ],
            'apellidos' => [
                'required',
                'string',
            ],
        ];
    }
}
