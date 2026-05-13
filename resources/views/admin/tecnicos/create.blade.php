@extends('layouts.app')
@section('title', 'Nuevo Técnico')
@section('content')
<h4 class="mb-4"><i class="bi bi-person-badge"></i> Nuevo Técnico</h4>
<div class="card border-0 shadow-sm p-4" style="max-width:500px">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.tecnicos.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre completo *</label>
            <input type="text" name="nombre_completo" class="form-control"
                   value="{{ old('nombre_completo') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Especialidad *</label>
            <select name="especialidad_id" class="form-select" required>
                <option value="">— Selecciona —</option>
                @foreach($especialidades as $e)
                    <option value="{{ $e->id }}" {{ old('especialidad_id') == $e->id ? 'selected' : '' }}>
                        {{ $e->nombre_especialidad }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Usuario vinculado</label>
            <select name="usuario_id" class="form-select">
                <option value="">— Sin vincular —</option>
                @foreach($usuarios as $u)
                    <option value="{{ $u->id }}" {{ old('usuario_id') == $u->id ? 'selected' : '' }}>
                        {{ $u->nombre }} ({{ $u->email }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="disponible" class="form-check-input" id="disponible" checked>
            <label class="form-check-label" for="disponible">Disponible</label>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Guardar</button>
            <a href="{{ route('admin.tecnicos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
