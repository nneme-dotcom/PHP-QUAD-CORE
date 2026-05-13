@extends('layouts.app')
@section('title', 'Técnicos')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-person-badge"></i> Técnicos</h4>
    <a href="{{ route('admin.tecnicos.create') }}" class="btn btn-danger btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo
    </a>
</div>
<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr><th>#</th><th>Nombre</th><th>Especialidad</th><th>Usuario</th><th>Disponible</th><th>Acciones</th></tr>
        </thead>
        <tbody>
        @forelse($tecnicos as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->nombre_completo }}</td>
                <td>{{ $t->especialidad->nombre_especialidad ?? '—' }}</td>
                <td>{{ $t->usuario->email ?? '—' }}</td>
                <td>
                    <span class="badge bg-{{ $t->disponible ? 'success' : 'secondary' }}">
                        {{ $t->disponible ? 'Sí' : 'No' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.tecnicos.edit', $t) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.tecnicos.destroy', $t) }}" class="d-inline"
                          onsubmit="return confirm('¿Eliminar técnico?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Sin técnicos.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
