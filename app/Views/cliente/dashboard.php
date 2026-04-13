<!-- Header -->
<div style="margin-bottom:24px">
  <span class="chip chip-blue">Mi cuenta</span>
  <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Bienvenido</h1>
  <p class="muted" style="margin:0;font-size:14px">Aquí puedes ver tus avisos y crear nuevas solicitudes.</p>
</div>

<!-- Quick actions -->
<div class="grid grid-2" style="margin-bottom:22px">
  <a href="/cliente/avisos/nuevo" class="card" style="
    text-decoration:none;
    background:linear-gradient(135deg,var(--orange) 0%,var(--orange-dk) 100%);
    border-color:var(--orange);
    display:flex;align-items:center;gap:16px;padding:22px 24px;
    box-shadow:0 4px 18px rgba(255,161,10,.30);
    transition:all .2s;
  " onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
    <div style="width:48px;height:48px;border-radius:14px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0">🚨</div>
    <div>
      <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:17px;color:#fff">Nueva solicitud</div>
      <div style="color:rgba(255,255,255,.8);font-size:13px">Solicitar un técnico ahora</div>
    </div>
  </a>
  <a href="/cliente/avisos" class="card" style="
    text-decoration:none;
    display:flex;align-items:center;gap:16px;padding:22px 24px;
    transition:all .2s;
  " onmouseover="this.style.borderColor='var(--blue)'" onmouseout="this.style.borderColor='var(--border)'">
    <div class="icon-badge" style="flex-shrink:0;width:48px;height:48px;border-radius:14px">📋</div>
    <div>
      <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:17px">Mis avisos</div>
      <div class="muted" style="font-size:13px">Ver historial completo</div>
    </div>
  </a>
</div>

<!-- Recent table -->
<div class="card">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
    <h2 style="margin:0">Últimos avisos</h2>
    <a href="/cliente/avisos" class="btn btn-sm">Ver todos →</a>
  </div>

  <?php if (empty($incs)): ?>
    <div style="text-align:center;padding:40px 20px">
      <div style="font-size:40px;margin-bottom:12px">🔧</div>
      <div style="font-weight:600;font-size:16px;margin-bottom:6px">Aún no tienes avisos</div>
      <p class="muted" style="font-size:14px;margin:0 0 18px">¿Tienes una avería? Solicita un técnico ahora.</p>
      <a href="/cliente/avisos/nuevo" class="btn btn-primary">Nueva solicitud</a>
    </div>
  <?php else: ?>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Localizador</th>
            <th>Servicio</th>
            <th>Fecha</th>
            <th>Urgencia</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (array_slice($incs,0,5) as $i): ?>
          <tr>
            <td>
              <a href="/cliente/avisos/ver?id=<?= $i['id'] ?>" style="font-weight:600;font-family:monospace;font-size:13px;color:var(--blue)">
                <?= htmlspecialchars($i['localizador']) ?>
              </a>
            </td>
            <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
            <td style="color:var(--muted);font-size:13px"><?= htmlspecialchars($i['fecha_servicio']) ?></td>
            <td><span class="badge badge-<?= strtolower($i['tipo_urgencia']) ?>"><?= $i['tipo_urgencia'] ?></span></td>
            <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
