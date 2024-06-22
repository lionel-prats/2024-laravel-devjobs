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
    // vacantes.categoria_id = categorias.id
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // relacion de muchos a uno con Salario (v222)
    // vacantes.salario_id = salarios.id
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }

    // relacion de una a muchos con Candidato (v233)
    // candidatos.vacante_id = vacantes.id
    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }

    // relacion de muchos a uno con User (v237)
    // vacantes.user_id = user.id
    // llamamos a la relacion "reclutador" y no "user", para que quede mas claro que la relacion es con reclutadores (user.rol = 2) y no con devs (user.rol = 1)
    // como no estamos siguiendo las convenciones de laravel, tenemos que indicar que la FK en vacantes es "user_id" (si a la relacion la hubiesemos llamado "user" no hubiese sido necesario)
    public function reclutador()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
