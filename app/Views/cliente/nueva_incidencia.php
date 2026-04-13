<?php use App\Core\Auth; ?>
<div style="max-width:680px;margin:0 auto">
  <div style="margin-bottom:22px">
    <span class="chip chip-orange">Nueva solicitud</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Solicitar técnico</h1>
    <p class="muted" style="margin:0;font-size:14px">Rellena el formulario para solicitar un servicio a domicilio.</p>
  </div>

  <?php if (!empty($error)): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <div class="alert alert-info" style="display:flex;gap:12px;align-items:flex-start">
    <span style="font-size:18px;flex-shrink:0">ℹ️</span>
    <div>
      <strong>Importante:</strong> Las solicitudes <em>Estándar</em> deben pedirse con mínimo <strong>48h de antelación</strong>.
      Las <em>Urgentes</em> se atienden en 24h y pueden tener tarifa adicional.
    </div>
  </div>

  <div class="card" style="margin-top:16px">
    <form method="post" action="/cliente/avisos/nuevo">
      <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">

      <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:14px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Tipo de servicio</div>
        <div class="grid grid-2">
          <div class="field">
            <label>Especialidad</label>
            <select name="especialidad_id" required>
              <?php foreach ($especialidades as $e): ?>
              <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['nombre_especialidad']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="field">
            <label>Urgencia</label>
            <select name="tipo_urgencia">
              <option value="Estandar">Estándar (48h mínimo)</option>
              <option value="Urgente">Urgente (24h)</option>
            </select>
          </div>
        </div>
      </div>

      <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:14px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Fecha y hora</div>
        <div class="grid grid-2">
          <div class="field">
            <label>Fecha y hora preferida</label>
            <input type="datetime-local" name="fecha_servicio" required>
          </div>
          <div class="field">
            <label>Franja horaria</label>
            <select name="franja_horaria">
              <option value="manana">Mañana (9h–14h)</option>
              <option value="tarde">Tarde (15h–20h)</option>
            </select>
          </div>
        </div>
      </div>

      <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:14px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Ubicación y contacto</div>
        <div class="field">
          <label>Dirección del servicio</label>
          <input name="direccion" required placeholder="Calle, número, piso, ciudad">
        </div>
        <div class="field">
          <label>Teléfono de contacto</label>
          <input name="telefono_contacto" required placeholder="6XX XXX XXX">
        </div>
      </div>

      <div style="margin-bottom:22px">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:14px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Descripción</div>
        <div class="field" style="margin:0">
          <label>Describe la avería</label>
          <textarea name="descripcion" rows="4" required placeholder="Explica brevemente el problema..."></textarea>
        </div>
      </div>

      <div class="actions">
        <button class="btn btn-primary btn-lg">Crear solicitud →</button>
        <a href="/cliente/avisos" class="btn btn-lg">Cancelar</a>
      </div>
    </form>
  </div>
</div>
