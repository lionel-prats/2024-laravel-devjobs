<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Illuminate\Support\Carbon;

class MostrarVacante extends Component
{
    // en este atributo se carga automaticamente la instancia de Vacante para poder accederla desde el template (v221)
    // esta instancia de Vacante se mandó desde la instancia de este componenete en resources\views\vacantes\show.blade.php (v221)
    public $vacante; 
    
    public function render()
    {
        return view('livewire.mostrar-vacante');
    }
}
