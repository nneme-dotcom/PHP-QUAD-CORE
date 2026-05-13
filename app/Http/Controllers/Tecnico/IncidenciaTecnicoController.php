<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Incidencia;
use App\Models\Tecnico;
use Illuminate\Http\Request;

class IncidenciaTecnicoController extends Controller
{
    private function getTecnicoId(): ?int
    {
        $tecnico = Tecnico::where('usuario_id', session('user_id'))->first();
        return $tecnico?->id;
    }

    public function index()
    {
        $tecnicoId = $this->getTecnicoId();
        $incidencias = Incidencia::with(['cliente', 'especialidad'])
            ->where('tecnico_id', $tecnicoId)
            ->orderBy('fecha_servicio')
            ->get();
        return view('tecnico.incidencias.index', compact('incidencias'));
    }

    public function show(Incidencia $incidencia)
    {
        if ($incidencia->tecnico_id !== $this->getTecnicoId()) {
            abort(403);
        }
        $incidencia->load(['cliente', 'especialidad']);
        return view('tecnico.incidencias.show', compact('incidencia'));
    }

    public function estado(Request $request, Incidencia $incidencia)
    {
        if ($incidencia->tecnico_id !== $this->getTecnicoId()) {
            abort(403);
        }
        $request->validate(['estado' => 'required|in:Asignada,Finalizada']);
        $incidencia->update(['estado' => $request->estado]);
        return back()->with('success', 'Estado actualizado.');
    }
}
