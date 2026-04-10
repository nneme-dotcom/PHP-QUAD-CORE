<?php
/**
 * Regenera los hashes de contraseña de los usuarios de prueba
 * con password_hash() real. Ejecutar UNA vez tras importar el SQL:
 *
 *   docker exec -it reparaya_php php /var/www/html/sql/seed_passwords.php
 */
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../app/Core/Database.php';

$pdo = App\Core\Database::getInstance();
$hash = password_hash('reparaya123', PASSWORD_DEFAULT);

$emails = [
    'admin@reparaya.test',
    'carlos@reparaya.test',
    'lucia@reparaya.test',
    'maria@cliente.test',
    'pedro@cliente.test',
];

$stmt = $pdo->prepare('UPDATE usuarios SET password = :p WHERE email = :e');
foreach ($emails as $e) {
    $stmt->execute(['p' => $hash, 'e' => $e]);
    echo "OK -> $e\n";
}
echo "\nContraseña común: reparaya123\n";
