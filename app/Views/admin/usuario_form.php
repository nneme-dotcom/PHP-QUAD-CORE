<?php use App\Core\Auth; ?>
<div style="max-width:620px;margin:0 auto">
  <div style="margin-bottom:22px">
    <span class="chip">Administración</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Editar usuario</h1>
  </div>

  <div class="card">
    <form method="post" action="/admin/usuarios/editar">
      <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
      <input type="hidden" name="id" value="<?= $u['id'] ?>">

      <div class="grid grid-2">
        <div class="field">
          <label>Nombre</label>
          <input name="nombre" value="<?= htmlspecialchars($u['nombre']) ?>" required>
        </div>
        <div class="field">
          <label>Apellidos</label>
          <input name="apellidos" value="<?= htmlspecialchars($u['apellidos'] ?? '') ?>">
        </div>
      </div>
      <div class="field">
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>" required>
      </div>
      <div class="field">
        <label>Teléfono</label>
        <input name="telefono" value="<?= htmlspecialchars($u['telefono'] ?? '') ?>" placeholder="6XX XXX XXX">
      </div>
      <div class="field">
        <label>Rol</label>
        <select name="rol">
          <option value="particular" <?= $u['rol']=='particular'?'selected':'' ?>>Particular (cliente)</option>
          <option value="tecnico"    <?= $u['rol']=='tecnico'?'selected':'' ?>>Técnico</option>
          <option value="admin"      <?= $u['rol']=='admin'?'selected':'' ?>>Administrador</option>
        </select>
      </div>

      <div class="actions" style="margin-top:4px">
        <button class="btn btn-primary btn-lg">Guardar cambios →</button>
        <a href="/admin/usuarios" class="btn btn-lg">Cancelar</a>
      </div>
    </form>
  </div>
</div>
