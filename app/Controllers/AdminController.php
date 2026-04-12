<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Especialidad;
use App\Models\Incidencia;
use App\Models\Tecnico;
use App\Models\Usuario;

class AdminController extends Controller
{
    public function dashboard(): void
    {
        $this->requireAuth('admin');
        $incModel = new Incidencia();
        $todas = $incModel->todasConDetalles();
        $stats = [
            'total'      => count($todas),
            'pendientes' => count(array_filter($todas, fn($i) => $i['estado'] === 'Pendiente')),
            'asignadas'  => count(array_filter($todas, fn($i) => $i['estado'] === 'Asignada')),
            'urgentes'   => count(array_filter($todas, fn($i) => $i['tipo_urgencia'] === 'Urgente')),
        ];
        $this->view('admin/dashboard', [
            'title' => 'Panel admin - ReparaYa',
            'stats' => $stats,
            'recientes' => array_slice($todas, 0, 5),
        ]);
    }

    public function incidencias(): void
    {
        $this->requireAuth('admin');
        $incs = (new Incidencia())->todasConDetalles();
        $tecs = (new Tecnico())->allWithDetails();
        $this->view('admin/incidencias_lista', [
            'title' => 'Incidencias - Admin',
            'incs'  => $incs,
            'tecs'  => $tecs,
        ]);
    }

    public function nuevaForm(): void
    {
        $this->requireAuth('admin');
        $this->view('admin/incidencia_form', [
            'title' => 'Nueva incidencia',
            'inc'   => null,
            'especialidades' => (new Especialidad())->all('nombre_especialidad'),
            'clientes'       => (new Usuario())->todosPorRol('particular'),
        ]);
    }

    public function nuevaStore(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();

        (new Incidencia())->create([
            'cliente_id'        => (int)$this->input('cliente_id'),
            'especialidad_id'   => (int)$this->input('especialidad_id'),
            'descripcion'       => $this->input('descripcion'),
            'direccion'         => $this->input('direccion'),
            'telefono_contacto' => $this->input('telefono_contacto'),
            'fecha_servicio'    => date('Y-m-d H:i:s', strtotime($this->input('fecha_servicio'))),
            'franja_horaria'    => $this->input('franja_horaria') === 'tarde' ? 'tarde' : 'manana',
            'tipo_urgencia'     => $this->input('tipo_urgencia') === 'Urgente' ? 'Urgente' : 'Estandar',
        ]);
        $this->redirect('/admin/incidencias');
    }

    public function editarForm(): void
    {
        $this->requireAuth('admin');
        $id  = (int)$this->input('id');
        $inc = (new Incidencia())->buscar($id);
        if (!$inc) { http_response_code(404); echo 'No encontrado'; return; }
        $this->view('admin/incidencia_form', [
            'title' => 'Editar incidencia ' . $inc['localizador'],
            'inc'   => $inc,
            'especialidades' => (new Especialidad())->all('nombre_especialidad'),
            'clientes'       => (new Usuario())->todosPorRol('particular'),
        ]);
    }

    public function editarStore(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        $id = (int)$this->input('id');
        (new Incidencia())->updateAdmin($id, [
            'especialidad_id'   => (int)$this->input('especialidad_id'),
            'descripcion'       => $this->input('descripcion'),
            'direccion'         => $this->input('direccion'),
            'telefono_contacto' => $this->input('telefono_contacto'),
            'fecha_servicio'    => date('Y-m-d H:i:s', strtotime($this->input('fecha_servicio'))),
            'franja_horaria'    => $this->input('franja_horaria') === 'tarde' ? 'tarde' : 'manana',
            'tipo_urgencia'     => $this->input('tipo_urgencia') === 'Urgente' ? 'Urgente' : 'Estandar',
        ]);
        $this->redirect('/admin/incidencias');
    }

    public function asignarTecnico(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        $id = (int)$this->input('id');
        $tec = $this->input('tecnico_id');
        (new Incidencia())->asignarTecnico($id, $tec ? (int)$tec : null);
        $this->redirect('/admin/incidencias');
    }

    public function cancelar(): void
    {
        $this->requireAuth('admin');
        $this->csrfCheck();
        $id = (int)$this->input('id');
        (new Incidencia())->cambiarEstado($id, 'Cancelada');
        $this->redirect('/admin/incidencias');
    }

    public function calendario(): void
    {
        $this->requireAuth('admin');
        $this->view('admin/calendario', ['title' => 'Calendario - Admin']);
    }

    /** Endpoint JSON para FullCalendar */
    public function apiEventos(): void
    {
        $this->requireAuth('admin');
        $incs = (new Incidencia())->todasConDetalles();
        $events = [];
        foreach ($incs as $i) {
            $events[] = [
                'id'    => $i['id'],
                'title' => $i['localizador'] . ' - ' . $i['nombre_especialidad'],
                'start' => str_replace(' ', 'T', $i['fecha_servicio']),
                'color' => $i['tipo_urgencia'] === 'Urgente' ? '#ef4444' : '#84cc16',
                'extendedProps' => [
                    'estado'  => $i['estado'],
                    'cliente' => $i['cliente_nombre'],
                    'tecnico' => $i['tecnico_nombre'],
                ],
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($events);
    }
}
