<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads; // trait de Livewire
use Illuminate\Support\Facades\Storage; // clase para poder eliminar archivos de storage (v215)

class EditarVacante extends Component
{

    // importación de trait de Livewire para poder enviar imagenes al servidor
    use WithFileUploads;

    // atributo para almacenar el id de la vacante a editar (v214)
    public $id; 

    // estos atributos se corresponden con los name de los elementos del form en editar-vacante.blade.php
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    // atributo donde cargaremos una posible nueva imagen cargada por el recruiter para la vacante a editar
    public $imagen_nueva;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024'
    ];

    public function mount(Vacante $vacante) // (v211)
    {
        // $vacante es instancia de Vacante, y se la debemos pasar a este componente cuando lo instanciamos desde algun blade (en este caso, lo estamos instanciando desde resources\views\vacantes\edit.blade.php - ver archivo -)

        // asigno el id de la vacante a editar al atributo $id (v214)
        $this->id = $vacante->id; 

        // bloque para asignar a los atributos de esta clase los valores de la instancia de Vacante
        // LiveWire precarga automaticamente los campos del form de editar vacante con los datos de estos atributos (v212)
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    } 

    public function editarVacante()
    {
        // $this->validate() es un metodo interno de LiveWire que validará que los campos de un form superen las validaciones definidas en el atributo $rules
        $datos = $this->validate();
       
        // si el recruiter cargo imagen nueva, elimino la vieja del storage y subo la nueva
        if($this->imagen_nueva){
            // elimino la imagen vieja de storage/public/vacantes
            Storage::delete("public/vacantes/$this->imagen");

            // subo la imagen nueva a storage/public/vacantes 
            // full path de la imagen actualizada en el server vvv 
            // "storage/public/vacantes/nombre_hasheado_po_livewire.jpg"
            // return almacenado en $full_path_imagen_actualizada vvv
            // "public/vacantes/nombre_hasheado_po_livewire.jpg"
            $full_path_imagen_actualizada = $this->imagen_nueva->store("public/vacantes"); 
    
            // obtengo el nombre de la imagen actualizada en storage/public/vacantes para el INSERT en DB
            $datos["imagen"] = str_replace("public/vacantes/", "", $full_path_imagen_actualizada);

            // mantengo vacía la carpeta storage\app\livewire-tmp (implementacion propia)
            $files = Storage::allFiles("livewire-tmp");
            Storage::delete($files);
        } 

        // instancio Vacanto con la vacante a editar 
        $vacante = Vacante::find($this->id);

        // actualizo los valores de la instancia de la vacante a editar con los que llegaron desde el form antes del UPDATE
        $vacante->titulo       = $datos["titulo"];
        $vacante->salario_id   = $datos["salario"];  
        $vacante->categoria_id = $datos["categoria"]; 
        $vacante->empresa      = $datos["empresa"]; 
        $vacante->ultimo_dia   = $datos["ultimo_dia"]; 
        $vacante->descripcion  = $datos["descripcion"]; 

        // si el recruiter actualizo la imagen, subo el nuevo nombre de la misma a la DB, caso contrario vacantes.imagen conservará el mismo string
        $vacante->imagen       = $datos["imagen"] ?? $vacante->imagen; 
    
        // UPDATE vacantes SET titulo=..., salario_id=..., categoria_id=..., empresa=..., ultimo_dia=..., descripcion=... WHERE id = $this->id
        $vacante->save();

        session()->flash("mensaje", "La Vacante se actualizó correctamente");

        // redirecciono al recruiter a http://devjobs.test/dashboard
        return redirect()->route("vacantes.index");
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
