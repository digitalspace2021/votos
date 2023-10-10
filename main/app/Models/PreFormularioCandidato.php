<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreFormularioCandidato extends Model
{
    use HasFactory;

    protected $table = 'pre_formulario_candidatos';

    protected $fillable = [
        'formulario_id',
        'candidato_id'
    ];

    public function formulario()
    {
        return $this->belongsTo(PreFormulario::class, 'formulario_id');
    }
}
