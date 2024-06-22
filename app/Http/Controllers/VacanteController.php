<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // VacantePolicy->viewAny() (v226)
        // Este policy solo permite acceder a http://devjobs.test/dashboard a recruiters (v226)
        $this->authorize("viewAny", Vacante::class); 

        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // VacantePolicy->create() (v227)
        // Este policy solo permite acceder a http://devjobs.test/vacantes/create a recruiters (v227)
        $this->authorize("create", Vacante::class); 
        
        return view('vacantes.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show', [
            "vacante" => $vacante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante)
    {
        // ejecucion de VacantePolicy->update()
        // este policy retorna true si pasa la validacion y en caso contrario detiene la ejecucion de este controlador retornando un error 403
        $this->authorize("update", $vacante); 

        return view('vacantes.edit', [
            "vacante" => $vacante
        ]);
    }
}
