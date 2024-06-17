<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads; // trait de Livewire (v197)

class CrearVacante extends Component
{

    // importación de trait de Livewire dentro de la clase para poder enviar imagenes al servidor (v197)
    use WithFileUploads;

    // estos atributos se corresponden con los name de los elementos del form en crear-vacante.blade.php (v193)
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    
    // reglas de validacion del formulario
    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024'
    ];

    // el submit del form ejecuta esta funcion (asi esta definido en <form ...>)
    public function crearVacante()
    {
        // esta linea realiza las validaciones definidas en $rules para cada campo (v194)
        $datos = $this->validate();
    }

    public function render()
    {
        // caso de uso con pluck() (ver notas v191)
        // $salarios = Salario::pluck("salario", "id");
       
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            "salarios" => $salarios,
            "categorias" => $categorias
        ]);
    }
}
