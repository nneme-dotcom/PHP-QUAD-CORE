<?php use App\Core\Auth; ?>
<div class="card" style="max-width:620px;margin:20px auto">
  <h2>Editar usuario</h2>
  <form method="post" action="/admin/usuarios/editar">
    <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
    <input type="hidden" name="id" value="<?= $u['id'] ?>">
    <div class="grid grid-2">
      <div class="field"><label>Nombre</label><input name="nombre" value="<?= htmlspecialchars($u['nombre']) ?>" required></div>
      <div class="field"><label>Apellidos</label><input name="apellidos" value="<?= htmlspecialchars($u['apellidos'] ?? '') ?>"></div>
    </div>
    <div class="field"><label>Email</label><input type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>" required></div>
    <div class="field"><label>Telefono</label><input name="telefono" value="<?= htmlspecialchars($u['telefono'] ?? '') ?>"></div>
    <div class="field"><label>Rol</label>
      <select name="rol">
        <option value="particular" <?= $u['rol']=='particular'?'selected':'' ?>>Particular</option>
        <option value="tecnico"    <?= $u['rol']=='tecnico'?'selected':'' ?>>Tecnico</option>
        <option value="admin"      <?= $u['rol']=='admin'?'selected':'' ?>>Administrador</option>
      </select>
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a href="/admin/usuarios" class="btn">Cancelar</a>
  </form>
</div>
