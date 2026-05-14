<?php

namespace App\Http\Controllers\Gestora;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\AgrupaComisionesPorMes;
use App\Models\EmpresaGestora;
use App\Models\Comision;

class ComisionController extends Controller
{
    use AgrupaComisionesPorMes;

    public function index()
    {
        $gestora = EmpresaGestora::where('usuario_id', session('user_id'))->firstOrFail();

        $comisiones = Comision::with('incidencia.especialidad')
            ->where('gestora_id', $gestora->id)
            ->orderBy('anio', 'desc')
            ->orderBy('mes', 'desc')
            ->get();

        $resumen        = $this->agruparPorMes($comisiones);
        $totalAcumulado = $comisiones->sum('importe_comision');

        return view('gestora.comisiones.index', compact('gestora', 'resumen', 'totalAcumulado'));
    }
}
