<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edil extends Model
{
    use HasFactory;

    protected $table = 'ediles';

    protected $fillable = [
        'edil_id',
        'asamblea_id',
        'concejo',
        'alcaldia',
        'gobernacion',
        'formulario_id'
    ];

    public function userEdil()
    {
        return $this->belongsTo(UserEdiles::class, 'edil_id');
    }

    public function userAsamblea()
    {
        return $this->belongsTo(UserEdiles::class, 'asamblea_id');
    }


    /* method create or update */
    public static function createOrUpdate($dataForm)
    {
        $edil = Edil::where('formulario_id', $dataForm['formulario_id'])->first();

        if ($edil) {
            $edil->update($dataForm);
        } else {
            $edil = Edil::create($dataForm);
        }

        return $edil;
    }
}
