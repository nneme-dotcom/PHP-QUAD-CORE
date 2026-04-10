<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('public/home', ['title' => 'ReparaYa - Reparaciones a domicilio']);
    }
    public function caracteristicas(): void
    {
        $this->view('public/caracteristicas', ['title' => 'Caracteristicas - ReparaYa']);
    }
    public function comoFunciona(): void
    {
        $this->view('public/como_funciona', ['title' => 'Como funciona - ReparaYa']);
    }
    public function contacto(): void
    {
        $this->view('public/contacto', ['title' => 'Contacto - ReparaYa']);
    }
}
