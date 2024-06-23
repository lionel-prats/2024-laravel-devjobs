<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;

class FiltrarVacantes extends Component
{
    // atributos sincronizados con los campos del <form wire:submit.prevent="leerDatosFormulario"> definido en filtrar-vacantes.blade.php
    public $termino;   // sincronizado con el <input wire:model="termino">
    public $categoria; // sincronizado con el <select wire:model="categoria">
    public $salario;   // sincronizado con el <select wire:model="salario">

    public function leerDatosFormulario() // v250
    {
        // con dispatch() emitimos el evento "terminosBusqueda"
        // en el componente padre (HomeVacantes) hay un listener escuchando por la emision de este evento, y cuando se emite, manda ejecutar el metodo HomeVacantes->buscar()
        // le pasamos los atributos sincronizados con los campos del <form wire:submit.prevent="leerDatosFormulario">, ya que el metodo buscar() espera estos 3 valores
        $this->dispatch("terminosBusqueda", $this->termino, $this->categoria, $this->salario);
    }
    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.filtrar-vacantes', [
            "salarios" => $salarios,
            "categorias" => $categorias
        ]);
    }
}
