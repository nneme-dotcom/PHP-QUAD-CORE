<div style="max-width:680px;margin:0 auto">
  <div style="margin-bottom:22px">
    <a href="/cliente/avisos" style="color:var(--muted);font-size:14px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;margin-bottom:14px" onmouseover="this.style.color='var(--blue)'" onmouseout="this.style.color='var(--muted)'">← Volver a mis avisos</a>
    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px">
      <div>
        <span class="chip chip-blue">Aviso</span>
        <h1 class="section-title" style="margin-top:10px;margin-bottom:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;letter-spacing:0">
          <code style="font-size:18px;background:var(--blue-dim);padding:4px 12px;border-radius:8px;color:var(--blue)">
            <?= htmlspecialchars($inc['localizador']) ?>
          </code>
        </h1>
      </div>
      <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
        <span class="badge badge-<?= strtolower($inc['estado']) ?>" style="font-size:12px;padding:5px 12px"><?= $inc['estado'] ?></span>
        <span class="badge badge-<?= strtolower($inc['tipo_urgencia']) ?>" style="font-size:12px;padding:5px 12px"><?= $inc['tipo_urgencia'] ?></span>
      </div>
    </div>
  </div>

  <div class="grid grid-2">
    <div class="card" style="padding:22px">
      <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Detalles del servicio</div>
      <div style="display:flex;flex-direction:column;gap:12px">
        <div style="display:flex;justify-content:space-between;font-size:14px;padding-bottom:10px;border-bottom:1px solid var(--border)">
          <span class="muted">Servicio</span>
          <span style="font-weight:600"><?= htmlspecialchars($inc['nombre_especialidad']) ?></span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:14px;padding-bottom:10px;border-bottom:1px solid var(--border)">
          <span class="muted">Fecha</span>
          <span style="font-weight:500"><?= htmlspecialchars($inc['fecha_servicio']) ?></span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:14px;padding-bottom:10px;border-bottom:1px solid var(--border)">
          <span class="muted">Franja</span>
          <span style="font-weight:500;text-transform:capitalize"><?= htmlspecialchars($inc['franja_horaria']) ?></span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:14px">
          <span class="muted">Técnico</span>
          <span style="font-weight:500">
            <?php if ($inc['tecnico_nombre'] ?? null): ?>
              <span style="color:var(--blue)"><?= htmlspecialchars($inc['tecnico_nombre']) ?></span>
            <?php else: ?>
              <span class="muted" style="font-style:italic">Sin asignar</span>
            <?php endif; ?>
          </span>
        </div>
      </div>
    </div>

    <div class="card" style="padding:22px">
      <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Contacto y ubicación</div>
      <div style="display:flex;flex-direction:column;gap:12px">
        <div style="font-size:14px">
          <div class="muted" style="margin-bottom:4px;font-size:12px">Dirección</div>
          <div style="font-weight:500"><?= htmlspecialchars($inc['direccion']) ?></div>
        </div>
        <div style="font-size:14px;padding-top:10px;border-top:1px solid var(--border)">
          <div class="muted" style="margin-bottom:4px;font-size:12px">Teléfono de contacto</div>
          <div style="font-weight:500"><?= htmlspecialchars($inc['telefono_contacto']) ?></div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:12px">Descripción de la avería</div>
    <p style="font-size:15px;line-height:1.65;color:var(--text);margin:0"><?= nl2br(htmlspecialchars($inc['descripcion'])) ?></p>
  </div>
</div>
