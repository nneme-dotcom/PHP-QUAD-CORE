<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Especialidad;
use App\Models\Incidencia;

class ClienteController extends Controller
{
    public function dashboard(): void
    {
        $this->requireAuth('particular');
        $incs = (new Incidencia())->porCliente(Auth::user()['id']);
        $this->view('cliente/dashboard', [
            'title' => 'Mi panel - ReparaYa',
            'incs'  => $incs,
        ]);
    }

    public function misAvisos(): void
    {
        $this->requireAuth('particular');
        $incs = (new Incidencia())->porCliente(Auth::user()['id']);
        $this->view('cliente/mis_avisos', [
            'title' => 'Mis avisos - ReparaYa',
            'incs'  => $incs,
        ]);
    }

    public function nuevoForm(): void
    {
        $this->requireAuth('particular');
        $espModel = new Especialidad();
        $this->view('cliente/nueva_incidencia', [
            'title'          => 'Nueva solicitud',
            'especialidades' => $espModel->all('nombre_especialidad ASC'),
            'error'          => $_GET['error'] ?? null,
        ]);
    }

    public function nuevoStore(): void
    {
        $this->requireAuth('particular');
        $this->csrfCheck();

        $fechaServicio = $this->input('fecha_servicio'); // YYYY-MM-DDTHH:MM
        if (!$fechaServicio) {
            $this->redirect(BASE_URL . '/cliente/avisos/nuevo?error=' . urlencode('Falta la fecha'));
        }
        $fechaTs = strtotime($fechaServicio);

        // ===> REGLA DE NEGOCIO 48 H (sólo para Estandar)
        $urgencia = $this->input('tipo_urgencia') === 'Urgente' ? 'Urgente' : 'Estandar';
        if ($urgencia === 'Estandar') {
            $minTs = time() + (HORAS_ANTELACION_ESTANDAR * 3600);
            if ($fechaTs < $minTs) {
                $this->redirect(BASE_URL . '/cliente/avisos/nuevo?error=' . urlencode(
                    'Las solicitudes Estandar requieren minimo 48h de antelacion'
                ));
            }
        }

        (new Incidencia())->create([
            'cliente_id'        => Auth::user()['id'],
            'especialidad_id'   => (int)$this->input('especialidad_id'),
            'descripcion'       => $this->input('descripcion'),
            'direccion'         => $this->input('direccion'),
            'telefono_contacto' => $this->input('telefono_contacto'),
            'fecha_servicio'    => date('Y-m-d H:i:s', $fechaTs),
            'franja_horaria'    => $this->input('franja_horaria') === 'tarde' ? 'tarde' : 'manana',
            'tipo_urgencia'     => $urgencia,
        ]);

        $this->redirect(BASE_URL . '/cliente/avisos');
    }

    public function ver(): void
    {
        $this->requireAuth('particular');
        $id = (int)$this->input('id');
        $inc = (new Incidencia())->buscar($id);
        if (!$inc || (int)$inc['cliente_id'] !== Auth::user()['id']) {
            http_response_code(404);
            echo 'Incidencia no encontrada';
            return;
        }
        $this->view('cliente/detalle', [
            'title' => 'Detalle aviso',
            'inc'   => $inc,
        ]);
    }

    public function cancelar(): void
    {
        $this->requireAuth('particular');
        $this->csrfCheck();

        $id  = (int)$this->input('id');
        $inc = (new Incidencia())->buscar($id);
        if (!$inc || (int)$inc['cliente_id'] !== Auth::user()['id']) {
            $this->redirect(BASE_URL . '/cliente/avisos');
        }

        // Regla 48h también para CANCELAR estándar
        if ($inc['tipo_urgencia'] === 'Estandar') {
            $diff = strtotime($inc['fecha_servicio']) - time();
            if ($diff < HORAS_ANTELACION_ESTANDAR * 3600) {
                $this->redirect(BASE_URL . '/cliente/avisos?error=' . urlencode(
                    'No se puede cancelar con menos de 48h de antelacion'
                ));
            }
        }

        (new Incidencia())->cambiarEstado($id, 'Cancelada');
        $this->redirect(BASE_URL . '/cliente/avisos');
    }
}
