@extends('layouts.app')
@section('title', 'Editar Especialidad')
@section('content')
<h4 class="mb-4"><i class="bi bi-wrench-adjustable"></i> Editar Especialidad</h4>
<div class="card border-0 shadow-sm p-4" style="max-width:500px">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.especialidades.update', $especialidad) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre_especialidad" class="form-control"
                   value="{{ old('nombre_especialidad', $especialidad->nombre_especialidad) }}" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Actualizar</button>
            <a href="{{ route('admin.especialidades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
