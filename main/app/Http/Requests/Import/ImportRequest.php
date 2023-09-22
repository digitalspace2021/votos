<?php

namespace App\Http\Requests\Import;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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
            'creador_id' => 'required|exists:users,id',
            'candidatos' => 'required|array',
            'candidatos.*' => 'required|exists:candidatos,id',
            'file' => 'required|array',
            'tipo_zona' => 'required|array',
            'tipo_zona.*' => 'required|in:Comuna,Corregimiento',
            'zona' => 'required|array',
        ];
    }
}
