<?php
namespace App\Models;

use App\Core\Model;

class Tecnico extends Model
{
    protected string $table = 'tecnicos';

    public function allWithDetails(): array
    {
        $sql = 'SELECT t.*, e.nombre_especialidad, u.email
                FROM tecnicos t
                LEFT JOIN especialidades e ON e.id = t.especialidad_id
                LEFT JOIN usuarios u       ON u.id = t.usuario_id
                ORDER BY t.id DESC';
        return $this->db->query($sql)->fetchAll();
    }

    public function create(array $d): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO tecnicos (usuario_id, nombre_completo, especialidad_id, disponible)
             VALUES (:usuario_id, :nombre, :esp, :disp)'
        );
        $stmt->execute([
            'usuario_id' => $d['usuario_id'] ?: null,
            'nombre'     => $d['nombre_completo'],
            'esp'        => $d['especialidad_id'],
            'disp'       => !empty($d['disponible']) ? 1 : 0,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $d): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE tecnicos SET usuario_id = :usuario_id, nombre_completo = :nombre,
             especialidad_id = :esp, disponible = :disp WHERE id = :id'
        );
        return $stmt->execute([
            'id'         => $id,
            'usuario_id' => $d['usuario_id'] ?: null,
            'nombre'     => $d['nombre_completo'],
            'esp'        => $d['especialidad_id'],
            'disp'       => !empty($d['disponible']) ? 1 : 0,
        ]);
    }
}
