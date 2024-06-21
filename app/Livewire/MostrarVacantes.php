<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class MostrarVacantes extends Component
{
    protected $listeners = ["eliminarVacante"];

    public function eliminarVacante(Vacante $vacante) 
    {
        // elimino la imagen de la vacante de storage\app\public\vacantes y finalmente elimino el registro de la tabla vacantes (v219)
        if(Storage::delete("public/vacantes/$vacante->imagen")){
            $vacante->delete();
        }
    }

    public function render()
    {
        $vacantes = Vacante::where("user_id", auth()->user()->id)
            ->oldest("ultimo_dia")
            ->paginate(4);

        return view('livewire.mostrar-vacantes', [
            "vacantes" => $vacantes
        ]);
    }
}
