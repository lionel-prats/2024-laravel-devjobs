<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Carbon;

class EditarVacante extends Component
{
    // estos atributos se corresponden con los name de los elementos del form en editar-vacante.blade.php
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
    ];

    public function editarVacante()
    {
        $datos = $this->validate();

        $relative_path_imagen_subida = $this->imagen->store("public/vacantes"); 
        $datos["imagen"] = str_replace("public/vacantes/", "", $relative_path_imagen_subida);

        Vacante::create([
            'titulo'       => $datos["titulo"],
            'salario_id'   => $datos["salario"],  
            'categoria_id' => $datos["categoria"], 
            'empresa'      => $datos["empresa"], 
            'ultimo_dia'   => $datos["ultimo_dia"], 
            'descripcion'  => $datos["descripcion"], 
            'imagen'       => $datos["imagen"], 
            'user_id'      => auth()->user()->id
        ]);

        session()->flash("mensaje", "La Vacante se publicó correctamente");
        return redirect()->route("vacantes.index");
    }

    public function mount(Vacante $vacante) // (v211)
    {
        // bloque para completar los campos del form de editar vacante con los datos del registro traidos de la DB (v212)
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    } 
   
    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();
        
        return view('livewire.editar-vacante', [
            "salarios" => $salarios,
            "categorias" => $categorias
        ]);
    }
}
