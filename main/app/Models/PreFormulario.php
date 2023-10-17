<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'mesa'
    ];

    public function candidatos()
    {
        return $this->belongsToMany(Candidato::class, 'pre_formulario_candidatos', 'formulario_id', 'candidato_id');
    }

    public function puestoVotacion()
    {
        return $this->belongsTo(PuestoVotacion::class, 'puesto_votacion', 'id');
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
