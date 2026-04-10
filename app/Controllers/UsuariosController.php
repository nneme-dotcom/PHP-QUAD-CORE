<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuario;

class UsuariosController extends Controller
{
    public function index(): void
    {
        $this->requireAuth('admin');
        $this->view('admin/usuarios_lista', [
            'title' => 'Usuarios - Admin',
            'users' => (new Usuario())->all('id DESC'),
        ]);
    }

    public function editForm(): void
    {
        $this->requireAuth('admin');
        $u = (new Usuario())->find((int)$this->input('id'));
        $this->view('admin/usuario_form', [
            'title' => 'Editar usuario',
            'u'     => $u,
        ]);
    }

    public function update(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        $id = (int)$this->input('id');
        $usuarioModel = new Usuario();
        $usuarioModel->update($id, [
            'nombre'    => $this->input('nombre'),
            'apellidos' => $this->input('apellidos'),
            'email'     => $this->input('email'),
            'telefono'  => $this->input('telefono'),
        ]);
        $usuarioModel->updateRol($id, $this->input('rol'));
        $this->redirect('/admin/usuarios');
    }

    public function destroy(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        (new Usuario())->delete((int)$this->input('id'));
        $this->redirect('/admin/usuarios');
    }
}
