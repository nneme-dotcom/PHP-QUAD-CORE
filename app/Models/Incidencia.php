<?php
namespace App\Models;

use App\Core\Model;

class Incidencia extends Model
{
    protected string $table = 'incidencias';

    /** SELECT base con joins legibles */
    private string $selectFull = "
        SELECT i.*,
               e.nombre_especialidad,
               c.nombre  AS cliente_nombre,
               c.email   AS cliente_email,
               t.nombre_completo AS tecnico_nombre
        FROM incidencias i
        LEFT JOIN especialidades e ON e.id = i.especialidad_id
        LEFT JOIN usuarios       c ON c.id = i.cliente_id
        LEFT JOIN tecnicos       t ON t.id = i.tecnico_id
    ";

    public function todasConDetalles(): array
    {
        return $this->db->query($this->selectFull . " ORDER BY i.fecha_servicio DESC")->fetchAll();
    }

    public function porCliente(int $clienteId): array
    {
        $stmt = $this->db->prepare($this->selectFull . " WHERE i.cliente_id = :c ORDER BY i.fecha_servicio DESC");
        $stmt->execute(['c' => $clienteId]);
        return $stmt->fetchAll();
    }

    public function porTecnicoUsuario(int $usuarioId): array
    {
        $stmt = $this->db->prepare($this->selectFull . "
            WHERE i.tecnico_id = (SELECT id FROM tecnicos WHERE usuario_id = :u LIMIT 1)
            ORDER BY i.fecha_servicio");
        $stmt->execute(['u' => $usuarioId]);
        return $stmt->fetchAll();
    }

    public function buscar(int $id): ?array
    {
        $stmt = $this->db->prepare($this->selectFull . " WHERE i.id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $d): int
    {
        $sql = "INSERT INTO incidencias
            (localizador, cliente_id, especialidad_id, descripcion, direccion,
             telefono_contacto, fecha_servicio, franja_horaria, tipo_urgencia, estado)
            VALUES
            (:loc, :cli, :esp, :desc, :dir, :tel, :fec, :fra, :urg, 'Pendiente')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'loc'  => $this->generarLocalizador(),
            'cli'  => $d['cliente_id'],
            'esp'  => $d['especialidad_id'],
            'desc' => $d['descripcion'],
            'dir'  => $d['direccion'],
            'tel'  => $d['telefono_contacto'],
            'fec'  => $d['fecha_servicio'],
            'fra'  => $d['franja_horaria'],
            'urg'  => $d['tipo_urgencia'],
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function updateAdmin(int $id, array $d): bool
    {
        $sql = "UPDATE incidencias SET
                  especialidad_id   = :esp,
                  descripcion       = :desc,
                  direccion         = :dir,
                  telefono_contacto = :tel,
                  fecha_servicio    = :fec,
                  franja_horaria    = :fra,
                  tipo_urgencia     = :urg
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id'   => $id,
            'esp'  => $d['especialidad_id'],
            'desc' => $d['descripcion'],
            'dir'  => $d['direccion'],
            'tel'  => $d['telefono_contacto'],
            'fec'  => $d['fecha_servicio'],
            'fra'  => $d['franja_horaria'],
            'urg'  => $d['tipo_urgencia'],
        ]);
    }

    public function asignarTecnico(int $incidenciaId, ?int $tecnicoId): bool
    {
        $estado = $tecnicoId ? 'Asignada' : 'Pendiente';
        $stmt = $this->db->prepare(
            'UPDATE incidencias SET tecnico_id = :t, estado = :e WHERE id = :id'
        );
        return $stmt->execute(['id' => $incidenciaId, 't' => $tecnicoId, 'e' => $estado]);
    }

    public function cambiarEstado(int $id, string $estado): bool
    {
        $stmt = $this->db->prepare('UPDATE incidencias SET estado = :e WHERE id = :id');
        return $stmt->execute(['id' => $id, 'e' => $estado]);
    }

    /** Genera localizador único tipo REP-2026-XXXX */
    private function generarLocalizador(): string
    {
        do {
            $cod = 'REP-' . date('Y') . '-' . str_pad((string)random_int(1, 9999), 4, '0', STR_PAD_LEFT);
            $stmt = $this->db->prepare('SELECT 1 FROM incidencias WHERE localizador = :l');
            $stmt->execute(['l' => $cod]);
        } while ($stmt->fetch());
        return $cod;
    }
}
