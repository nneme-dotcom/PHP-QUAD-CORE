<?php use App\Core\Auth; ?>
<div class="form-card">
  <div class="card">
    <div class="card-header">
      <div style="font-size:36px;margin-bottom:10px">🔐</div>
      <h2>Bienvenido de vuelta</h2>
      <p>Accede a tu cuenta de ReparaYa</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="/login">
      <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
      <div class="field">
        <label>Email</label>
        <input type="email" name="email" required placeholder="tu@email.com">
      </div>
      <div class="field">
        <label>Contraseña</label>
        <input type="password" name="password" required placeholder="••••••••">
      </div>
      <button class="btn btn-primary" style="width:100%;justify-content:center;margin-top:4px">Entrar →</button>
    </form>

    <div style="margin-top:18px;text-align:center;padding-top:16px;border-top:1px solid var(--border)">
      <span class="muted" style="font-size:14px">¿No tienes cuenta? </span>
      <a href="/registro" style="font-weight:600;font-size:14px">Regístrate gratis</a>
    </div>
  </div>
</div>
