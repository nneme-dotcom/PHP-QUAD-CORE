@extends('layouts.app')
@section('title', 'Especialidades')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-wrench-adjustable"></i> Especialidades</h4>
    <a href="{{ route('admin.especialidades.create') }}" class="btn btn-danger btn-sm">
        <i class="bi bi-plus-lg"></i> Nueva
    </a>
</div>
<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr><th>#</th><th>Nombre</th><th>Acciones</th></tr>
        </thead>
        <tbody>
        @forelse($especialidades as $e)
            <tr>
                <td>{{ $e->id }}</td>
                <td>{{ $e->nombre_especialidad }}</td>
                <td>
                    <a href="{{ route('admin.especialidades.edit', $e) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.especialidades.destroy', $e) }}" class="d-inline"
                          onsubmit="return confirm('¿Eliminar especialidad?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center text-muted">Sin especialidades.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
