<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    // en estos atributos, cuando se emita el evento terminosBusqueda, vamos a almacenar los valores de los campos del formulario buscador definido en el componente hijo filtrar-vacantes.blade.php (v250)
    public $termino;   
    public $categoria; 
    public $salario;   

    // escuchamos por el evento 'terminosBusqueda' (disparado en el componente hijo FiltrarVacantes->leerDatosFormulario()) 
    // cuando detectamos que se emitió el evento, mandamos ejecutar el metodo HomeVacante->buscar()
    protected $listeners = ["terminosBusqueda" => "buscar"]; // v250

    public function buscar($termino, $categoria, $salario) // v250
    {
        // a los atributos de esta clase, le asignamos los valores que nos llega desde el evento terminosBusqueda, emitido en el componente hijo FiltrarVacantes->leerDatosFormulario(), que son los valores de los 3 campos del form buscador definido en filtrar-vacantes.php, al momente del click en "btn.buscar"
        $this->termino = $termino;   
        $this->categoria = $categoria; 
        $this->salario = $salario;
    }

    public function render()
    {
        // $vacantes = Vacante::all();

        // $this->termino = "apli";   
        // $this->categoria = ""; 
        // $this->salario = 6;

        $vacantes = Vacante::when($this->termino, function($query){
            $query->where(function($query) {
                $query
                    ->where("titulo", "LIKE", "%" . $this->termino . "%")
                    ->orWhere("empresa", "LIKE", "%" . $this->termino . "%");
            });
        })
        ->when($this->categoria, function($query){
            $query->where("categoria_id", $this->categoria);
        })
        ->when($this->salario, function($query){
            $query->where("salario_id", $this->salario);
        });

        // $vacantes = $vacantes->get();
        $vacantes = $vacantes->paginate(5);
        // $vacantes = $vacantes->toSql();
        // ddl($vacantes, "pe");

        /* 
        // SQL equivalente en caso de que existan los 3 filtros vvv
        SELECT * 
        FROM vacantes 
        WHERE (titulo LIKE "%$this->termino%" OR titulo LIKE "%$this->termino%")
        AND categoria_id = $this->categoria
        AND salario_id = $this->salario
        */
        
        return view('livewire.home-vacantes', [
            "vacantes" => $vacantes,
        ]);
    }
}
