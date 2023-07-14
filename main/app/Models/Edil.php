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
        'concejo',
        'alcaldia',
        'gobernacion',
        'formulario_id'
    ];

    public function userEdil()
    {
        return $this->belongsTo(UserEdiles::class, 'edil_id');
    }
}
