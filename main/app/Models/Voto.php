<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    use HasFactory;

    protected $table='votos';

    protected $fillable =[
        'voto',
        'form_id',
    ];

    public function formularios(){
        return $this->belongsTo(Formulario::class);
    }
    
    public function candidatos(){
        return $this->hasManyThrough(
            Candidato::class, 
            Formulario::class,
            'id',
            'id',
            'form_id',
            'candidato_id'
        );
    }
}
