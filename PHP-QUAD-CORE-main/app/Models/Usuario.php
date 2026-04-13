<?php
namespace App\Models;

use App\Core\Model;

class Usuario extends Model
{
    protected string $table = 'usuarios';

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $d): int
    {
        $sql = 'INSERT INTO usuarios (nombre, apellidos, email, password, rol, telefono)
                VALUES (:nombre, :apellidos, :email, :password, :rol, :telefono)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nombre'    => $d['nombre'],
            'apellidos' => $d['apellidos'] ?? null,
            'email'     => $d['email'],
            'password'  => password_hash($d['password'], PASSWORD_DEFAULT),
            'rol'       => $d['rol'] ?? 'particular',
            'telefono'  => $d['telefono'] ?? null,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $d): bool
    {
        $sql = 'UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, telefono = :telefono WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id'        => $id,
            'nombre'    => $d['nombre'],
            'apellidos' => $d['apellidos'] ?? null,
            'email'     => $d['email'],
            'telefono'  => $d['telefono'] ?? null,
        ]);
    }

    public function updatePassword(int $id, string $newPassword): bool
    {
        $stmt = $this->db->prepare('UPDATE usuarios SET password = :p WHERE id = :id');
        return $stmt->execute([
            'id' => $id,
            'p'  => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);
    }

    public function updateRol(int $id, string $rol): bool
    {
        $stmt = $this->db->prepare('UPDATE usuarios SET rol = :r WHERE id = :id');
        return $stmt->execute(['id' => $id, 'r' => $rol]);
    }

    public function todosPorRol(string $rol): array
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE rol = :r ORDER BY nombre');
        $stmt->execute(['r' => $rol]);
        return $stmt->fetchAll();
    }
}
