<?php use App\Core\Auth; ?>
<div style="max-width:560px;margin:0 auto">
  <div style="margin-bottom:22px">
    <span class="chip">Mi cuenta</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Mi perfil</h1>
    <p class="muted" style="margin:0;font-size:14px">Actualiza tus datos personales y contraseña.</p>
  </div>

  <?php if (!empty($flash)): ?>
    <div class="alert alert-success">✅ Datos guardados correctamente.</div>
  <?php endif; ?>

  <div class="card">
    <form method="post" action="/perfil">
      <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">

      <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Datos personales</div>
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
        <div class="field" style="margin-bottom:0">
          <label>Teléfono</label>
          <input name="telefono" value="<?= htmlspecialchars($u['telefono'] ?? '') ?>" placeholder="6XX XXX XXX">
        </div>
      </div>

      <div style="margin-bottom:22px">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Cambiar contraseña</div>
        <div class="field" style="margin-bottom:0">
          <label>Nueva contraseña <span style="font-weight:400;font-size:12px">(dejar en blanco para no cambiar)</span></label>
          <input type="password" name="password" placeholder="••••••••">
        </div>
      </div>

      <button class="btn btn-primary btn-lg" style="width:100%;justify-content:center">Guardar cambios</button>
    </form>
  </div>
</div>
