@extends('layouts.app')
@section('title', 'Nueva Incidencia')
@section('content')
<h4 class="mb-4"><i class="bi bi-clipboard-plus"></i> Nueva Incidencia</h4>
<div class="card border-0 shadow-sm p-4" style="max-width:650px">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('cliente.incidencias.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
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
            <div class="col-md-6">
                <label class="form-label">Teléfono de contacto *</label>
                <input type="text" name="telefono_contacto" class="form-control"
                       value="{{ old('telefono_contacto') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Dirección del servicio *</label>
                <input type="text" name="direccion" class="form-control"
                       value="{{ old('direccion') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Descripción del problema *</label>
                <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha *</label>
                <input type="date" name="fecha_servicio" class="form-control"
                       value="{{ old('fecha_servicio') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Franja horaria *</label>
                <select name="franja_horaria" class="form-select" required>
                    <option value="manana" {{ old('franja_horaria') === 'manana' ? 'selected' : '' }}>Mañana</option>
                    <option value="tarde"  {{ old('franja_horaria') === 'tarde'  ? 'selected' : '' }}>Tarde</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Urgencia *</label>
                <select name="tipo_urgencia" class="form-select" required>
                    <option value="Estandar" {{ old('tipo_urgencia') === 'Estandar' ? 'selected' : '' }}>Estándar</option>
                    <option value="Urgente"  {{ old('tipo_urgencia') === 'Urgente'  ? 'selected' : '' }}>Urgente</option>
                </select>
            </div>
        </div>
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-danger">Enviar aviso</button>
            <a href="{{ route('cliente.incidencias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
