<?php

namespace App\Livewire;
// use App\Models\Candidato;
use App\Models\Vacante;
use Livewire\Component;
use Illuminate\Support\Facades\Storage; // clase para poder eliminar archivos de storage
use Livewire\WithFileUploads; // trait de Livewire para la carga de archivos en el server

class PostularVacante extends Component
{
    // importación de trait de Livewire dentro de la clase para poder enviar archivos al servidor 
    use WithFileUploads;
    
    public $vacante; 

    // atributo conectado al input wire:model="cv" del template (v231) 
    public $cv;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        // asigno al atributo $vacante de esta clase, la instancia de Vacante enviada como argumento en la instanciacion de este componente, en resources\views\livewire\mostrar-vacante.blade.php (v233)
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $datos = $this->validate();

        // bloque para almacenar CV en el disco duro y mantener vacia la carpeta storage\app\livewire-tmp
        $relative_path_cv_subido = $this->cv->store("public/cv");
        $datos["cv"] = str_replace("public/cv/", "", $relative_path_cv_subido);
        $files = Storage::allFiles("livewire-tmp");
        Storage::delete($files);
        
        // Bolque para el INSERT en candidatos (v233)
        // en este caso, me sirvo de la relacion de uno a muchos entre vacantes y candidatos, definida en Vacante 
        // como el INSERT lo estoy realizando desde una instancia de Vacante que incluye el id de la vacante a la cual se esta postulando un dev, no hace falta especificar el id para el campo candidatos.vacante_id
        $this->vacante->candidatos()->create([
            'user_id'    => auth()->user()->id,
            'cv'         => $datos["cv"]
        ]);
        
        // crear notificacion y enviar email

        // mostrar al usuario un mensaje de ok
        session()->flash("mensaje", "Se envió correctamente tu información, mucha suerte");
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
