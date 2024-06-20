<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads; // trait de Livewire (v197)
use Illuminate\Support\Facades\Storage; // clase para poder eliminar archivos de storage (v215)

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
    
    // LiveWire hace uso de las reglas de validacion de este atributo que tiene que llamarse $rules, para la validacion del formulario
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
        // si salta algun error de validacion hace un return back automatico con los mensajes de error 
        // si pasa las validaciones, en $datos se guarda un array asociativo con la info cargada por el recruiter
        $datos = $this->validate();
        /* 
        $datos = [
            "titulo"      => "titulo de la publicacion 1"
            "salario"     => "2"
            "categoria"   => "4"
            "empresa"     => "uber"
            "ultimo_dia"  => "2024-06-27"
            "descripcion" => "descripcion de la publicacion 1"
            "imagen"      => Livewire\Features\SupportFileUploads
        ];
        */

        // bloque para Almacenar la imagen y obtener el nombre para el INSERT /////////////
        $relative_path_imagen_subida = $this->imagen->store("public/vacantes");
        // ver notas v202
        // full path de la imagen almacenada vvv 
        // "storage/public/vacantes/LFBTUWpxvI4BI4bJic1IVgEElCmSssDizVO3e7GF.jpg"
        // return almacenado en $relative_path_imagen_subida vvv
        // "public/vacantes/LFBTUWpxvI4BI4bJic1IVgEElCmSssDizVO3e7GF.jpg"
        $datos["imagen"] = str_replace("public/vacantes/", "", $relative_path_imagen_subida);
        // "LFBTUWpxvI4BI4bJic1IVgEElCmSssDizVO3e7GF.jpg";
        // fin bloque /////////////////////////////////////////////////////////////////////

        // mantengo vacía la carpeta storage\app\livewire-tmp (implementacion propia)
        $files = Storage::allFiles("livewire-tmp");
        Storage::delete($files);

        // Bolque para el INSERT de la publicacion en vacantes
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
        // fin bloque

        session()->flash("mensaje", "La Vacante se publicó correctamente");
        return redirect()->route("vacantes.index");
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
