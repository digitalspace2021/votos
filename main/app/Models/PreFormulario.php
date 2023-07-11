<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreFormulario extends Model
{
    use HasFactory;

    protected $table = 'pre_formularios';

    protected $fillable = [
        'propietario_id',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'genero',
        'direccion',
        'zona',
        'puesto_votacion',
        'mensaje',
        'tipo_zona',
        'candidato_id',
        'identificacion',
    ];
}
