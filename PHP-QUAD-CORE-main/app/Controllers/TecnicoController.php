<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Incidencia;

class TecnicoController extends Controller
{
    public function dashboard(): void
    {
        $this->requireAuth('tecnico');
        $incs = (new Incidencia())->porTecnicoUsuario(Auth::user()['id']);
        $this->view('tecnico/dashboard', [
            'title' => 'Panel tecnico - ReparaYa',
            'incs'  => $incs,
        ]);
    }

    public function agenda(): void
    {
        $this->requireAuth('tecnico');
        $incs = (new Incidencia())->porTecnicoUsuario(Auth::user()['id']);
        $this->view('tecnico/agenda', [
            'title' => 'Mi agenda',
            'incs'  => $incs,
        ]);
    }
}
