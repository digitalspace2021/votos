<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulariosCandidatos extends Model
{
    use HasFactory;

    protected $table = 'formulario_candidatos';

    protected $fillable = [
        'formulario_id',
        'candidato_id',
    ];
}
