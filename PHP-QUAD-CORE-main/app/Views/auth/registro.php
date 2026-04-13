<?php use App\Core\Auth; ?>
<div class="card" style="max-width:520px;margin:40px auto">
  <h2>Crear cuenta</h2>
  <?php if (!empty($error)): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post" action="<?= BASE_URL ?>/registro">
    <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
    <div class="grid grid-2">
      <div class="field"><label>Nombre *</label><input name="nombre" required></div>
      <div class="field"><label>Apellidos</label><input name="apellidos"></div>
    </div>
    <div class="field"><label>Email *</label><input type="email" name="email" required></div>
    <div class="field"><label>Telefono</label><input name="telefono"></div>
    <div class="grid grid-2">
      <div class="field"><label>Contrasena *</label><input type="password" name="password" required></div>
      <div class="field"><label>Repetir *</label><input type="password" name="password2" required></div>
    </div>
    <button class="btn btn-primary" style="width:100%">Registrarme</button>
  </form>
  <p class="muted" style="margin-top:14px;text-align:center">Ya tienes cuenta? <a href="<?= BASE_URL ?>/login">Acceder</a></p>
</div>
