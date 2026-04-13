<div style="padding-top:16px;margin-bottom:28px">
  <span class="chip">Equipo</span>
  <h1 class="section-title" style="font-size:28px;margin-top:12px">Contacto</h1>
  <p class="muted" style="font-size:15px">Proyecto académico — Universitat Oberta de Catalunya.</p>
</div>

<div class="grid grid-2">
  <div class="card" style="padding:28px">
    <h2 style="margin-bottom:18px">Equipo PHP QUAD-CORE</h2>
    <div style="display:flex;flex-direction:column;gap:12px">
      <?php
      $team = [
        ['name'=>'Nadir Neme Rodríguez','role'=>'Desarrollo & Arquitectura'],
        ['name'=>'Ana Patricia Calabuig','role'=>'Backend & Documentación'],
        ['name'=>'David Vaz Perales','role'=>'Backend & Testing'],
        ['name'=>'Óscar Ruiz Ollobarren','role'=>'Backend & Despliegue'],
      ];
      foreach ($team as $m): ?>
      <div style="display:flex;align-items:center;gap:14px;padding:12px;background:var(--surface2);border-radius:10px;border:1px solid var(--border)">
        <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--blue-dark));display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:15px;flex-shrink:0">
          <?= strtoupper(mb_substr($m['name'],0,1)) ?>
        </div>
        <div>
          <div style="font-weight:600;font-size:15px"><?= htmlspecialchars($m['name']) ?></div>
          <div style="font-size:12px;color:var(--muted)"><?= htmlspecialchars($m['role']) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="card" style="padding:28px;display:flex;flex-direction:column;gap:18px">
    <h2 style="margin-bottom:4px">Sobre el proyecto</h2>
    <div style="background:var(--blue-dim);border:1px solid #b3d4f7;border-radius:10px;padding:16px">
      <div style="font-weight:700;color:var(--blue-dark);margin-bottom:4px">FP.448</div>
      <div style="font-size:14px;color:var(--muted)">Desarrollo back-end con PHP, framework MVC y gestor de contenido</div>
    </div>
    <div style="background:var(--cream);border:1px solid var(--cream-dk);border-radius:10px;padding:16px">
      <div style="font-weight:700;color:#4a6928;margin-bottom:4px">Universitat Oberta de Catalunya</div>
      <div style="font-size:14px;color:var(--muted)">Proyecto académico de desarrollo web. PHP nativo con arquitectura MVC, MySQL y Docker.</div>
    </div>
    <div style="background:#fff3e0;border:1px solid #fed7aa;border-radius:10px;padding:16px">
      <div style="font-weight:700;color:#c45f00;margin-bottom:4px">🛠️ Stack</div>
      <div style="font-size:14px;color:var(--muted)">PHP · MySQL · Docker · Apache · MVC propio</div>
    </div>
  </div>
</div>
