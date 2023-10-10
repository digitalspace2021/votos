<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrizSeguimiento extends Model
{
    use HasFactory;
    protected $table = 'matriz_seguimiento';
    

    public function candidatos()
    {
        return $this->belongsToMany(Candidato::class, 'formulario_candidatos', 'formulario_id', 'candidato_id');
    }
}
