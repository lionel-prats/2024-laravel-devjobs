<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function __invoke()
    {
        // $classes = ($active ?? false) ? 'gauchito' : 'gil';
        
        $variable = false;
        $variable1 = $variable ?? false ? true : false;
        $variable2 = isset($variable) ? true : false;
        // ddl('$variable1 = ' . ($variable1 ? "true" : "false")); // false
        // ddl('$variable2 = ' . ($variable2 ? "true" : "false"), "pe"); // true

        return view('pruebas.index');
    }
}
