<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;

    protected $fillable = [
        'propietario_id',
        'candidato_id',
        'identificacion',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'genero',
        'direccion',
        'tipo_zona',
        'zona',
        'puesto_votacion',
        'mensaje',
        'estado',
        'vinculo',
        'foto',
        'mesa',
        'fecha_nacimiento',
        
    ];

    public function edil()
    {
        return $this->hasOne(Edil::class, 'formulario_id');
    }
}
