<?php

namespace App\Imports;

use App\Models\Formulario;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FormImport implements ToModel,  WithValidation, WithHeadingRow
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $new_data = [
            'nombre' => $row['nombres'],
            'apellido' => $row['apellidos'],
            'email' => $row['email'],
            'telefono' => $row['telefono'],
            'genero' => $row['genero'],
            'direccion' => $row['direccion'],
            'puesto_votacion' => $row['puesto_votacion'],
            'mensaje' => $row['mensaje'],
            'identificacion' => $row['identificacion']
        ];

        if ($this->validateIdNumber($row['identificacion'])) {
            return new Formulario(array_merge($new_data, $this->data));
        }
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
            'identificacion' => [
                'required',
            ],
            'mensaje' => [
                'required',
                'string',
            ],
            'puesto_votacion' => [
                'required',
                'string',
            ],
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
