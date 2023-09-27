<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'per_descrip'
        
    ];

    public function edil()
    {
        return $this->hasOne(Edil::class, 'formulario_id');
    }

    /**
     * The function "candidatos" returns a BelongsToMany relationship between the current class and the
     * "Candidato" class, using the "formulario_candidatos" pivot table and the "formulario_id" and
     * "candidato_id" foreign keys.
     * 
     * @return BelongsToMany a BelongsToMany relationship between the current model and the Candidato
     * model.
     */
    public function candidatos(): BelongsToMany
    {
        return $this->belongsToMany(Candidato::class, 'formulario_candidatos', 'formulario_id', 'candidato_id');
    }
}
