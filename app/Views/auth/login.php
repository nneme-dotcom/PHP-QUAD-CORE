<?php use App\Core\Auth; ?>
<div class="card" style="max-width:440px;margin:60px auto">
  <h2>Acceder</h2>
  <?php if (!empty($error)): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post" action="/login">
    <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
    <div class="field"><label>Email</label><input type="email" name="email" required></div>
    <div class="field"><label>Contrasena</label><input type="password" name="password" required></div>
    <button class="btn btn-primary" style="width:100%">Entrar</button>
  </form>
  <p class="muted" style="margin-top:14px;text-align:center">No tienes cuenta? <a href="/registro">Registrate</a></p>
</div>
