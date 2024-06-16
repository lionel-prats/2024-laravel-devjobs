<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;

class CrearVacante extends Component
{
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
