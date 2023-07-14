<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEdiles extends Model
{
    use HasFactory;

    protected $table = 'usuarios_ediles';

    protected $fillable = [
        'identificacion',
        'nombres',
        'apellidos',
        'email',
        'direccion',
        'tipo_zona',
        'zona',
        'descripcion',
        'genero'
    ];
}
