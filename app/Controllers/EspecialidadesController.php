<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Especialidad;

class EspecialidadesController extends Controller
{
    public function index(): void
    {
        $this->requireAuth('admin');
        $this->view('admin/especialidades_lista', [
            'title' => 'Maestro de especialidades',
            'esps'  => (new Especialidad())->all('nombre_especialidad ASC'),
        ]);
    }

    public function store(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        $nombre = $this->input('nombre_especialidad');
        if ($nombre) (new Especialidad())->create($nombre);
        $this->redirect('/admin/especialidades');
    }

    public function update(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        (new Especialidad())->update((int)$this->input('id'), $this->input('nombre_especialidad'));
        $this->redirect('/admin/especialidades');
    }

    public function destroy(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        (new Especialidad())->delete((int)$this->input('id'));
        $this->redirect('/admin/especialidades');
    }
}
