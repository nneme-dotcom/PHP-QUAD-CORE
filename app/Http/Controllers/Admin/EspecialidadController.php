<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();
        return view('admin.especialidades.index', compact('especialidades'));
    }

    public function create()
    {
        return view('admin.especialidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_especialidad' => 'required|string|max:50|unique:especialidades',
        ]);
        Especialidad::create($request->only('nombre_especialidad'));
        return redirect()->route('admin.especialidades.index')
                         ->with('success', 'Especialidad creada correctamente.');
    }

    public function edit(Especialidad $especialidad)
    {
        return view('admin.especialidades.edit', compact('especialidad'));
    }

    public function update(Request $request, Especialidad $especialidad)
    {
        $request->validate([
            'nombre_especialidad' => 'required|string|max:50|unique:especialidades,nombre_especialidad,' . $especialidad->id,
        ]);
        $especialidad->update($request->only('nombre_especialidad'));
        return redirect()->route('admin.especialidades.index')
                         ->with('success', 'Especialidad actualizada.');
    }

    public function destroy(Especialidad $especialidad)
    {
        $especialidad->delete();
        return redirect()->route('admin.especialidades.index')
                         ->with('success', 'Especialidad eliminada.');
    }
}
