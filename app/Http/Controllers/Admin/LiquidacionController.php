<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\AgrupaComisionesPorMes;
use App\Models\EmpresaGestora;

class LiquidacionController extends Controller
{
    use AgrupaComisionesPorMes;

    public function index()
    {
        $gestoras = EmpresaGestora::with(['comisiones' => function ($q) {
            $q->with('incidencia')->orderBy('anio', 'desc')->orderBy('mes', 'desc');
        }])->get();

        $liquidaciones = $gestoras->map(fn($gestora) => [
            'gestora'         => $gestora,
            'por_mes'         => $this->agruparPorMes($gestora->comisiones),
            'total_acumulado' => $gestora->comisiones->sum('importe_comision'),
        ]);

        return view('admin.liquidaciones.index', compact('liquidaciones'));
    }
}
