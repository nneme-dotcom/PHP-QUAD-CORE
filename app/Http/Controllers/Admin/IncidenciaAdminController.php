<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incidencia;
use App\Models\Especialidad;
use App\Models\Tecnico;
use Illuminate\Http\Request;

class IncidenciaAdminController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::with(['cliente', 'tecnico', 'especialidad'])
                                 ->orderBy('created_at', 'desc')->get();
        return view('admin.incidencias.index', compact('incidencias'));
    }

    public function show(Incidencia $incidencia)
    {
        $incidencia->load(['cliente', 'tecnico.especialidad', 'especialidad']);
        $tecnicos = Tecnico::with('especialidad')->where('disponible', true)->get();
        return view('admin.incidencias.show', compact('incidencia', 'tecnicos'));
    }

    public function edit(Incidencia $incidencia)
    {
        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();
        $tecnicos = Tecnico::with('especialidad')->get();
        return view('admin.incidencias.edit', compact('incidencia', 'especialidades', 'tecnicos'));
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        $request->validate([
            'especialidad_id'   => 'required|exists:especialidades,id',
            'descripcion'       => 'required|string',
            'direccion'         => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:20',
            'fecha_servicio'    => 'required|date',
            'franja_horaria'    => 'required|in:manana,tarde',
            'tipo_urgencia'     => 'required|in:Estandar,Urgente',
        ]);

        $incidencia->update($request->only([
            'especialidad_id', 'descripcion', 'direccion',
            'telefono_contacto', 'fecha_servicio', 'franja_horaria', 'tipo_urgencia',
        ]));

        return redirect()->route('admin.incidencias.show', $incidencia)
                         ->with('success', 'Incidencia actualizada.');
    }

    public function destroy(Incidencia $incidencia)
    {
        $incidencia->delete();
        return redirect()->route('admin.incidencias.index')
                         ->with('success', 'Incidencia eliminada.');
    }

    public function asignar(Request $request, Incidencia $incidencia)
    {
        $request->validate(['tecnico_id' => 'nullable|exists:tecnicos,id']);
        $tecnicoId = $request->tecnico_id ?: null;
        $incidencia->update([
            'tecnico_id' => $tecnicoId,
            'estado'     => $tecnicoId ? 'Asignada' : 'Pendiente',
        ]);
        return back()->with('success', 'Técnico asignado correctamente.');
    }

    public function estado(Request $request, Incidencia $incidencia)
    {
        $request->validate(['estado' => 'required|in:Pendiente,Asignada,Finalizada,Cancelada']);
        $incidencia->update(['estado' => $request->estado]);
        return back()->with('success', 'Estado actualizado.');
    }
}
