<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmpresaGestora;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GestoraAdminController extends Controller
{
    public function index()
    {
        $gestoras = EmpresaGestora::with('usuario')->orderBy('id', 'desc')->get();
        return view('admin.gestoras.index', compact('gestoras'));
    }

    public function create()
    {
        return view('admin.gestoras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'              => 'required|string|max:100',
            'cif'                 => 'required|string|max:20|unique:empresas_gestoras',
            'email'               => 'required|email|unique:empresas_gestoras',
            'telefono'            => 'nullable|string|max:20',
            'porcentaje_comision' => 'required|numeric|min:0|max:100',
            'password'            => 'required|min:6',
        ]);

        // Crear usuario con rol gestora
        $user = User::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => 'gestora',
            'telefono' => $request->telefono,
        ]);

        // Crear empresa gestora vinculada al usuario
        EmpresaGestora::create([
            'nombre'              => $request->nombre,
            'cif'                 => $request->cif,
            'email'               => $request->email,
            'telefono'            => $request->telefono,
            'porcentaje_comision' => $request->porcentaje_comision,
            'usuario_id'          => $user->id,
        ]);

        return redirect()->route('admin.gestoras.index')
                         ->with('success', 'Gestora creada correctamente.');
    }

    public function show(EmpresaGestora $gestora)
    {
        $gestora->load(['usuario', 'incidencias.especialidad', 'comisiones']);
        return view('admin.gestoras.show', compact('gestora'));
    }

    public function edit(EmpresaGestora $gestora)
    {
        return view('admin.gestoras.edit', compact('gestora'));
    }

    public function update(Request $request, EmpresaGestora $gestora)
    {
        $request->validate([
            'nombre'              => 'required|string|max:100',
            'cif'                 => 'required|string|max:20|unique:empresas_gestoras,cif,' . $gestora->id,
            'telefono'            => 'nullable|string|max:20',
            'porcentaje_comision' => 'required|numeric|min:0|max:100',
        ]);

        $gestora->update($request->only('nombre', 'cif', 'telefono', 'porcentaje_comision'));
        return redirect()->route('admin.gestoras.index')
                         ->with('success', 'Gestora actualizada.');
    }

    public function destroy(EmpresaGestora $gestora)
    {
        $gestora->delete();
        return redirect()->route('admin.gestoras.index')
                         ->with('success', 'Gestora eliminada.');
    }
}
