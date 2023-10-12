<?php

namespace App\Imports;

use App\Models\Formulario;
use App\Models\PreFormulario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FormImport implements ToModel,  WithValidation, WithHeadingRow
{
    use Importable;
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
        try {
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

            /* using validations of method rules */
            Validator::make($new_data, $this->rules());

            //return new PreFormulario(array_merge($new_data, $this->data));

            DB::beginTransaction();

            $preFormulario = PreFormulario::create(array_merge($new_data, $this->data));
            $preFormulario->candidatos()->attach($this->data['candidatos']);

            DB::commit();

        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function validateIdNumber($identificacion): bool
    {
        if (PreFormulario::firstWhere('identificacion', $identificacion)) {
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
                'unique:pre_formularios,identificacion',
                'unique:formularios,identificacion'
            ],
            'mensaje' => [
                'string',
                'nullable'
            ],
            'puesto_votacion' => [
                'string',
                'nullable'
            ],
            'direccion' => [
                'string',
                'nullable'
            ],
            'genero' => [
                'required',
                'string',
            ],
            'telefono' => [
                'required',
            ],
            'email' => [
                'email',
                'nullable'
            ],
            'apellidos' => [
                'required',
                'string',
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'identificacion.unique' => 'El número de identificación ya se encuentra registrado',
        ];
    }
}
