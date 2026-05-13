<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Tecnico;
use App\Models\User;
use App\Models\EmpresaGestora;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [];

        if (session('user_rol') === 'admin') {
            $stats = [
                'incidencias' => Incidencia::count(),
                'tecnicos'    => Tecnico::count(),
                'usuarios'    => User::count(),
                'gestoras'    => EmpresaGestora::count(),
            ];
        }

        return view('dashboard.index', compact('stats'));
    }
}
