<?php use App\Core\Auth; ?>
<div class="card">
  <h2>Maestro de especialidades</h2>
  <form method="post" action="/admin/especialidades/nueva" style="display:flex;gap:10px;align-items:flex-end;max-width:520px;margin-bottom:18px">
    <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
    <div class="field" style="flex:1;margin:0">
      <label>Nueva especialidad</label>
      <input name="nombre_especialidad" placeholder="Ej: Climatizacion" required>
    </div>
    <button class="btn btn-primary">Anadir</button>
  </form>

  <table>
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php foreach ($esps as $e): ?>
    <tr>
      <td>#<?= $e['id'] ?></td>
      <td>
        <form method="post" action="/admin/especialidades/editar" style="display:flex;gap:6px">
          <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
          <input type="hidden" name="id" value="<?= $e['id'] ?>">
          <input name="nombre_especialidad" value="<?= htmlspecialchars($e['nombre_especialidad']) ?>">
          <button class="btn btn-sm">Guardar</button>
        </form>
      </td>
      <td>
        <form method="post" action="/admin/especialidades/borrar" style="display:inline">
          <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
          <input type="hidden" name="id" value="<?= $e['id'] ?>">
          <button class="btn btn-sm btn-danger" onclick="return confirm('Borrar?')">Borrar</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
