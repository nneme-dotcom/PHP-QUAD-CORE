<?php
namespace App\Controllers;

use App\Core\Database;
use PDO;

class ApiController
{
    public function serviciosZonas(): void
    {
        // Importante: Limpiar cualquier buffer previo para que solo salga el JSON
        if (ob_get_length()) ob_clean();

        header('Content-Type: application/json; charset=utf-8');

        try {
            $db = Database::getConnection();
            $sql = "SELECT localizador, COUNT(*) AS total_servicios 
                    FROM incidencias 
                    GROUP BY localizador 
                    ORDER BY localizador ASC";
            
            $stmt = $db->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'ok' => true,
                'data' => $data
            ], JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'ok' => false,
                'error' => $e->getMessage()
            ]);
        }
        exit; // Asegura que no se imprima nada más después del JSON
    }
}