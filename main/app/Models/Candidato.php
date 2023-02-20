<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidato extends Model
{
    use HasFactory;
    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
