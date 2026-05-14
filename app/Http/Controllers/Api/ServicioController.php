<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Zona;
use App\Models\Incidencia;

class ServicioController extends Controller
{
    public function zonas()
    {
        $totalGlobal = Incidencia::whereNotNull('zona_id')->count();

        $zonas = Zona::withCount('incidencias')->get()->map(function ($zona) use ($totalGlobal) {
            return [
                'zona'             => $zona->nombre,
                'total_servicios'  => $zona->incidencias_count,
                'porcentaje'       => $totalGlobal > 0
                    ? round($zona->incidencias_count * 100 / $totalGlobal, 2)
                    : 0,
            ];
        });

        return response()->json([
            'ok'   => true,
            'data' => $zonas,
        ]);
    }
}
