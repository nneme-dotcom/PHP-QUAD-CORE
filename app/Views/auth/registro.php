<?php use App\Core\Auth; ?>
<div class="form-card" style="max-width:520px">
  <div class="card">
    <div class="card-header">
      <div style="font-size:36px;margin-bottom:10px">🛠️</div>
      <h2>Crear cuenta</h2>
      <p>Únete a ReparaYa y gestiona tus reparaciones</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="/registro">
      <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
      <div class="grid grid-2">
        <div class="field">
          <label>Nombre *</label>
          <input name="nombre" required placeholder="Tu nombre">
        </div>
        <div class="field">
          <label>Apellidos</label>
          <input name="apellidos" placeholder="Tus apellidos">
        </div>
      </div>
      <div class="field">
        <label>Email *</label>
        <input type="email" name="email" required placeholder="tu@email.com">
      </div>
      <div class="field">
        <label>Teléfono</label>
        <input name="telefono" placeholder="6XX XXX XXX">
      </div>
      <div class="grid grid-2">
        <div class="field">
          <label>Contraseña *</label>
          <input type="password" name="password" required placeholder="••••••••">
        </div>
        <div class="field">
          <label>Repetir *</label>
          <input type="password" name="password2" required placeholder="••••••••">
        </div>
      </div>
      <button class="btn btn-primary" style="width:100%;justify-content:center;margin-top:4px">Crear mi cuenta →</button>
    </form>

    <div style="margin-top:18px;text-align:center;padding-top:16px;border-top:1px solid var(--border)">
      <span class="muted" style="font-size:14px">¿Ya tienes cuenta? </span>
      <a href="/login" style="font-weight:600;font-size:14px">Acceder</a>
    </div>
  </div>
</div>
