<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tecnico;
use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    public function index()
    {
        $tecnicos = Tecnico::with(['especialidad', 'usuario'])->orderBy('id', 'desc')->get();
        return view('admin.tecnicos.index', compact('tecnicos'));
    }

    public function create()
    {
        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();
        $usuarios = User::where('rol', 'tecnico')->orderBy('nombre')->get();
        return view('admin.tecnicos.create', compact('especialidades', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:100',
            'especialidad_id' => 'required|exists:especialidades,id',
            'usuario_id'      => 'nullable|exists:usuarios,id',
            'disponible'      => 'nullable|boolean',
        ]);

        Tecnico::create([
            'nombre_completo' => $request->nombre_completo,
            'especialidad_id' => $request->especialidad_id,
            'usuario_id'      => $request->usuario_id ?: null,
            'disponible'      => $request->has('disponible') ? 1 : 0,
        ]);

        return redirect()->route('admin.tecnicos.index')
                         ->with('success', 'Técnico creado correctamente.');
    }

    public function edit(Tecnico $tecnico)
    {
        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();
        $usuarios = User::where('rol', 'tecnico')->orderBy('nombre')->get();
        return view('admin.tecnicos.edit', compact('tecnico', 'especialidades', 'usuarios'));
    }

    public function update(Request $request, Tecnico $tecnico)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:100',
            'especialidad_id' => 'required|exists:especialidades,id',
            'usuario_id'      => 'nullable|exists:usuarios,id',
        ]);

        $tecnico->update([
            'nombre_completo' => $request->nombre_completo,
            'especialidad_id' => $request->especialidad_id,
            'usuario_id'      => $request->usuario_id ?: null,
            'disponible'      => $request->has('disponible') ? 1 : 0,
        ]);

        return redirect()->route('admin.tecnicos.index')
                         ->with('success', 'Técnico actualizado.');
    }

    public function destroy(Tecnico $tecnico)
    {
        $tecnico->delete();
        return redirect()->route('admin.tecnicos.index')
                         ->with('success', 'Técnico eliminado.');
    }
}
