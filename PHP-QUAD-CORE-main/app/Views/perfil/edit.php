<?php use App\Core\Auth; ?>
<div class="card" style="max-width:560px;margin:30px auto">
  <h2>Mi perfil</h2>
  <?php if (!empty($flash)): ?><div class="alert alert-success">Datos guardados.</div><?php endif; ?>
  <form method="post" action="<?= BASE_URL ?>/perfil">
    <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
    <div class="grid grid-2">
      <div class="field"><label>Nombre</label><input name="nombre" value="<?= htmlspecialchars($u['nombre']) ?>" required></div>
      <div class="field"><label>Apellidos</label><input name="apellidos" value="<?= htmlspecialchars($u['apellidos'] ?? '') ?>"></div>
    </div>
    <div class="field"><label>Email</label><input type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>" required></div>
    <div class="field"><label>Telefono</label><input name="telefono" value="<?= htmlspecialchars($u['telefono'] ?? '') ?>"></div>
    <hr>
    <div class="field"><label>Nueva contrasena (opcional)</label><input type="password" name="password" placeholder="Dejar en blanco para no cambiar"></div>
    <button class="btn btn-primary">Guardar cambios</button>
  </form>
</div>
