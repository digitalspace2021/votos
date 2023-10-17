<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

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

    public function creador()
    {
        return $this->belongsTo(User::class, 'propietario_id');
    }

    public function voto()
    {
        return $this->hasOne(Voto::class, 'form_id');
    }

    public function puestoVotacion()
    {
        return $this->belongsTo(PuestoVotacion::class, 'puesto_votacion');
    }

    /**
     * Returns the location of the form based on the type of zone and zone id.
     *
     * @return string The location of the form in the format "general - location".
     */
    public function ubicacion(): string
    {
        switch ($this->tipo_zona) {
            case 'Comuna':
                $ubication = DB::table('comunas')
                    ->join('barrios', 'comunas.id', '=', 'barrios.comuna_id')
                    ->where('barrios.id', $this->zona)
                    ->select('comunas.name as general', 'barrios.name as location')
                    ->first();
                break;
            case 'Corregimiento':
                $ubication = DB::table('corregimientos')
                    ->join('veredas', 'veredas.corregimiento_id', '=', 'corregimientos.id')
                    ->where('veredas.id', $this->zona)
                    ->select('corregimientos.name as general', 'veredas.name as location')
                    ->first();
                break;

            default:
                return 'No definido';
                break;
        }

        return "$ubication->general - $ubication->location";
    }
}
