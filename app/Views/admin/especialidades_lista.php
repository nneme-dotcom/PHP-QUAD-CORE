<?php use App\Core\Auth; ?>
<div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px">
  <div>
    <span class="chip chip-blue">Administración</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Maestro de especialidades</h1>
    <p class="muted" style="margin:0;font-size:14px">Gestiona los tipos de servicio disponibles.</p>
  </div>
</div>

<!-- Add new -->
<div class="card" style="margin-bottom:20px">
  <h2 style="margin-bottom:16px;font-size:16px">Añadir especialidad</h2>
  <form method="post" action="/admin/especialidades/nueva" style="display:flex;gap:10px;align-items:flex-end;max-width:520px">
    <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
    <div class="field" style="flex:1;margin:0">
      <label>Nombre de la especialidad</label>
      <input name="nombre_especialidad" placeholder="Ej: Climatización" required>
    </div>
    <button class="btn btn-primary" style="flex-shrink:0">Añadir</button>
  </form>
</div>

<!-- List -->
<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th style="width:60px">ID</th>
          <th>Nombre</th>
          <th style="width:120px">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($esps as $e): ?>
        <tr>
          <td style="font-size:13px;color:var(--muted);font-weight:600">#<?= $e['id'] ?></td>
          <td>
            <form method="post" action="/admin/especialidades/editar" style="display:flex;gap:8px;align-items:center">
              <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
              <input type="hidden" name="id" value="<?= $e['id'] ?>">
              <input name="nombre_especialidad" value="<?= htmlspecialchars($e['nombre_especialidad']) ?>"
                style="font-size:14px;padding:6px 10px;border:1.5px solid var(--border);background:var(--bg);color:var(--text);border-radius:7px;font-family:inherit;max-width:300px;transition:border-color .18s"
                onfocus="this.style.borderColor='var(--blue)'" onblur="this.style.borderColor='var(--border)'">
              <button class="btn btn-sm">Guardar</button>
            </form>
          </td>
          <td>
            <form method="post" action="/admin/especialidades/borrar" style="display:inline">
              <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
              <input type="hidden" name="id" value="<?= $e['id'] ?>">
              <button class="btn btn-sm btn-danger" onclick="return confirm('¿Borrar esta especialidad?')">Borrar</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
