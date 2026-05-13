<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmpresaGestora;
use App\Models\Comision;

class LiquidacionController extends Controller
{
    public function index()
    {
        // Agrupar comisiones por gestora y mes
        $gestoras = EmpresaGestora::with(['comisiones' => function ($q) {
            $q->with('incidencia')->orderBy('anio', 'desc')->orderBy('mes', 'desc');
        }])->get();

        // Totales por gestora agrupados por mes/año
        $liquidaciones = $gestoras->map(function ($gestora) {
            $porMes = $gestora->comisiones->groupBy(fn($c) => $c->anio . '-' . str_pad($c->mes, 2, '0', STR_PAD_LEFT));
            return [
                'gestora' => $gestora,
                'por_mes' => $porMes->map(fn($grupo) => [
                    'mes'     => $grupo->first()->mes,
                    'anio'    => $grupo->first()->anio,
                    'total'   => $grupo->sum('importe_comision'),
                    'servicios' => $grupo->count(),
                ]),
                'total_acumulado' => $gestora->comisiones->sum('importe_comision'),
            ];
        });

        return view('admin.liquidaciones.index', compact('liquidaciones'));
    }
}
