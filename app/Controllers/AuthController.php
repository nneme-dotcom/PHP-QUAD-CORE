<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        Auth::start();
        $this->view('auth/login', ['title' => 'Acceder - ReparaYa', 'error' => $_GET['error'] ?? null]);
    }

    public function doLogin(): void
    {
        $this->csrfCheck();
        $email = $this->input('email');
        $pass  = $this->input('password');

        $usuarioModel = new Usuario();
        $user = $usuarioModel->findByEmail($email);

        if (!$user || !password_verify($pass, $user['password'])) {
            $this->redirect('/login?error=' . urlencode('Email o contrasena incorrectos'));
        }

        Auth::login($user);
        $this->redirectByRol($user['rol']);
    }

    public function showRegistro(): void
    {
        Auth::start();
        $this->view('auth/registro', ['title' => 'Registro - ReparaYa', 'error' => $_GET['error'] ?? null]);
    }

    public function doRegistro(): void
    {
        $this->csrfCheck();

        $nombre    = $this->input('nombre');
        $apellidos = $this->input('apellidos');
        $email     = $this->input('email');
        $telefono  = $this->input('telefono');
        $pass      = $this->input('password');
        $pass2     = $this->input('password2');

        if (!$nombre || !$email || !$pass) {
            $this->redirect('/registro?error=' . urlencode('Faltan campos obligatorios'));
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect('/registro?error=' . urlencode('Email no valido'));
        }
        if ($pass !== $pass2 || strlen($pass) < 6) {
            $this->redirect('/registro?error=' . urlencode('Las contrasenas no coinciden o son muy cortas'));
        }

        $usuarioModel = new Usuario();
        if ($usuarioModel->findByEmail($email)) {
            $this->redirect('/registro?error=' . urlencode('Ese email ya esta registrado'));
        }

        $id = $usuarioModel->create([
            'nombre'    => $nombre,
            'apellidos' => $apellidos,
            'email'     => $email,
            'password'  => $pass,
            'telefono'  => $telefono,
            'rol'       => 'particular',
        ]);

        $user = $usuarioModel->find($id);
        Auth::login($user);
        $this->redirect('/cliente');
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/');
    }

    private function redirectByRol(string $rol): void
    {
        switch ($rol) {
            case 'admin':      $this->redirect('/admin'); break;
            case 'tecnico':    $this->redirect('/tecnico'); break;
            default:           $this->redirect('/cliente');
        }
    }
}
