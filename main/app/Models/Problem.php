<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $table = 'problems';

    protected $fillable = ['link', 'status', 'description', 'form_id'];

    
    public function form()
    {
        return $this->belongsTo(Formulario::class, 'form_id', 'id');
    }
}
