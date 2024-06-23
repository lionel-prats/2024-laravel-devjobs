<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'vacante_id', 
        'cv'
    ];

    // relacion de muchos a uno con User (v246)
    // candidatos.user_id = user.id
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
