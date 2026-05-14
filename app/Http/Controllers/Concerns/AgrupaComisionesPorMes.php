<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Support\Collection;

trait AgrupaComisionesPorMes
{
    protected function agruparPorMes(Collection $comisiones): Collection
    {
        return $comisiones
            ->groupBy(fn($c) => $c->anio . '-' . str_pad($c->mes, 2, '0', STR_PAD_LEFT))
            ->map(fn($grupo) => [
                'mes'       => $grupo->first()->mes,
                'anio'      => $grupo->first()->anio,
                'total'     => $grupo->sum('importe_comision'),
                'servicios' => $grupo->count(),
                'detalle'   => $grupo,
            ]);
    }
}
