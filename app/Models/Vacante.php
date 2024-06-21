<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 
        'salario_id', 
        'categoria_id', 
        'empresa', 
        'ultimo_dia', 
        'descripcion', 
        'imagen', 
        'publicado', 
        'user_id'
    ];

    // atributo donde podemos aclararle a Laravel con que formato queremos que procese los datos de los campos de la tabla
    // implementamos esto en el v206 para el campo ultimo_dia, ya que pese a ser DATE en la DB, Laravel lo toma como un string, y casteandolo a datetime podemos, por ejemplo, formatearlo como fecha (v206)
    protected $casts = [
        'ultimo_dia' => 'datetime',
    ];

    // relacion de muchos a uno con Categoria (v222)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // relacion de muchos a uno con Salario (v222)
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }


}
