<?php

namespace App\Http\Controllers;

use App\Models\Gestora;
use Illuminate\Http\Request;

class GestoraController extends Controller
{
    /**
     * Muestra la lista de gestoras (Punto A y B)
     */
    public function index()
    {
        // Recuperamos los datos de la base de datos
        $gestoras = Gestora::all();

        // Llamamos a la vista que está en resources/views/gestoras/index.blade.php
        return view('gestoras/index', compact('gestoras'));
    }
}