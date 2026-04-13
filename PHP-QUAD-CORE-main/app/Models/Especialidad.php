<?php
namespace App\Models;

use App\Core\Model;

class Especialidad extends Model
{
    protected string $table = 'especialidades';

    public function create(string $nombre): int
    {
        $stmt = $this->db->prepare('INSERT INTO especialidades (nombre_especialidad) VALUES (:n)');
        $stmt->execute(['n' => $nombre]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, string $nombre): bool
    {
        $stmt = $this->db->prepare('UPDATE especialidades SET nombre_especialidad = :n WHERE id = :id');
        return $stmt->execute(['id' => $id, 'n' => $nombre]);
    }
}
