@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-people"></i> Usuarios</h4>
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-danger btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo
    </a>
</div>
<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr><th>#</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Teléfono</th><th>Acciones</th></tr>
        </thead>
        <tbody>
        @forelse($usuarios as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->nombre }} {{ $u->apellidos }}</td>
                <td>{{ $u->email }}</td>
                <td>
                    <span class="badge bg-{{ $u->rol === 'admin' ? 'danger' : ($u->rol === 'tecnico' ? 'primary' : ($u->rol === 'gestora' ? 'warning text-dark' : 'secondary')) }}">
                        {{ $u->rol }}
                    </span>
                </td>
                <td>{{ $u->telefono ?? '—' }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.edit', $u) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.usuarios.destroy', $u) }}" class="d-inline"
                          onsubmit="return confirm('¿Eliminar usuario?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Sin usuarios.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
