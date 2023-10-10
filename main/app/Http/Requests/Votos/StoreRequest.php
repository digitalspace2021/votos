<?php

namespace App\Http\Requests\Votos;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'form_id' => 'required|exists:formularios,id',
            'voto' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'form_id.required' => 'El formulario es requerido',
            'form_id.exists' => 'El formulario no existe',
        ];
    }
}
