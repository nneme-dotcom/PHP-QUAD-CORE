<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Usuario;

class PerfilController extends Controller
{
    public function edit(): void
    {
        $this->requireAuth();
        $u = (new Usuario())->find(Auth::user()['id']);
        $this->view('perfil/edit', [
            'title' => 'Mi perfil - ReparaYa',
            'u'     => $u,
            'flash' => $_GET['ok'] ?? null,
            'error' => $_GET['error'] ?? null,
        ]);
    }

    public function update(): void
    {
        $this->requireAuth();
        $this->csrfCheck();

        $id = Auth::user()['id'];
        $usuarioModel = new Usuario();

        $usuarioModel->update($id, [
            'nombre'    => $this->input('nombre'),
            'apellidos' => $this->input('apellidos'),
            'email'     => $this->input('email'),
            'telefono'  => $this->input('telefono'),
        ]);

        $newPass = $this->input('password');
        if ($newPass && strlen($newPass) >= 6) {
            $usuarioModel->updatePassword($id, $newPass);
        }

        // Refresca la sesión con los nuevos datos
        $user = $usuarioModel->find($id);
        Auth::login($user);

        $this->redirect(BASE_URL . '/perfil?ok=1');
    }
}
