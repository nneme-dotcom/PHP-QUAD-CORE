<?php

namespace App\Http\Controllers\Gestora;

use App\Http\Controllers\Controller;
use App\Models\EmpresaGestora;
use App\Models\Comision;

class ComisionController extends Controller
{
    public function index()
    {
        $gestora = EmpresaGestora::where('usuario_id', session('user_id'))->firstOrFail();

        $comisiones = Comision::with('incidencia.especialidad')
            ->where('gestora_id', $gestora->id)
            ->orderBy('anio', 'desc')
            ->orderBy('mes', 'desc')
            ->get();

        // Agrupar por mes/año
        $porMes = $comisiones->groupBy(fn($c) => $c->anio . '-' . str_pad($c->mes, 2, '0', STR_PAD_LEFT));

        $resumen = $porMes->map(fn($grupo) => [
            'mes'      => $grupo->first()->mes,
            'anio'     => $grupo->first()->anio,
            'total'    => $grupo->sum('importe_comision'),
            'servicios'=> $grupo->count(),
            'detalle'  => $grupo,
        ]);

        $totalAcumulado = $comisiones->sum('importe_comision');

        return view('gestora.comisiones.index', compact('gestora', 'resumen', 'totalAcumulado'));
    }
}
