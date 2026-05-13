<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('id', 'desc')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellidos'=> 'nullable|string|max:150',
            'email'    => 'required|email|unique:usuarios',
            'password' => 'required|min:6',
            'rol'      => 'required|in:admin,tecnico,particular,gestora',
            'telefono' => 'nullable|string|max:20',
        ]);

        User::create([
            'nombre'   => $request->nombre,
            'apellidos'=> $request->apellidos,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => $request->rol,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellidos'=> 'nullable|string|max:150',
            'email'    => 'required|email|unique:usuarios,email,' . $usuario->id,
            'rol'      => 'required|in:admin,tecnico,particular,gestora',
            'telefono' => 'nullable|string|max:20',
        ]);

        $data = $request->only('nombre', 'apellidos', 'email', 'rol', 'telefono');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);
        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')
                         ->with('success', 'Usuario eliminado.');
    }
}
