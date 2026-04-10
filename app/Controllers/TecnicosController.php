<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Especialidad;
use App\Models\Tecnico;
use App\Models\Usuario;

class TecnicosController extends Controller
{
    public function index(): void
    {
        $this->requireAuth('admin');
        $this->view('admin/tecnicos_lista', [
            'title' => 'Maestro de tecnicos',
            'tecs'  => (new Tecnico())->allWithDetails(),
        ]);
    }

    public function nuevoForm(): void
    {
        $this->requireAuth('admin');
        $this->view('admin/tecnico_form', [
            'title' => 'Nuevo tecnico',
            'tec'   => null,
            'especialidades' => (new Especialidad())->all('nombre_especialidad'),
            'usuarios' => (new Usuario())->todosPorRol('tecnico'),
        ]);
    }

    public function store(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        (new Tecnico())->create([
            'usuario_id'      => (int)$this->input('usuario_id'),
            'nombre_completo' => $this->input('nombre_completo'),
            'especialidad_id' => (int)$this->input('especialidad_id'),
            'disponible'      => (bool)$this->input('disponible'),
        ]);
        $this->redirect('/admin/tecnicos');
    }

    public function editForm(): void
    {
        $this->requireAuth('admin');
        $tec = (new Tecnico())->find((int)$this->input('id'));
        $this->view('admin/tecnico_form', [
            'title' => 'Editar tecnico',
            'tec'   => $tec,
            'especialidades' => (new Especialidad())->all('nombre_especialidad'),
            'usuarios' => (new Usuario())->todosPorRol('tecnico'),
        ]);
    }

    public function update(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        (new Tecnico())->update((int)$this->input('id'), [
            'usuario_id'      => (int)$this->input('usuario_id'),
            'nombre_completo' => $this->input('nombre_completo'),
            'especialidad_id' => (int)$this->input('especialidad_id'),
            'disponible'      => (bool)$this->input('disponible'),
        ]);
        $this->redirect('/admin/tecnicos');
    }

    public function destroy(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        (new Tecnico())->delete((int)$this->input('id'));
        $this->redirect('/admin/tecnicos');
    }
}
