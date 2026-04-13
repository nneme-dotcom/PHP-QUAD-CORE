<div style="padding-top:16px;margin-bottom:28px">
  <span class="chip chip-orange">Proceso</span>
  <h1 class="section-title" style="font-size:28px;margin-top:12px">¿Cómo funciona ReparaYa?</h1>
  <p class="muted" style="font-size:15px;max-width:540px">De la avería al técnico en tu puerta, en pasos simples.</p>
</div>

<div style="display:flex;flex-direction:column;gap:16px;margin-bottom:28px">

  <?php
  $steps = [
    ['num'=>'01','icon'=>'📝','color'=>'var(--blue)','bg'=>'var(--blue-dim)','title'=>'Regístrate',
     'desc'=>'Crea tu cuenta con tu email en menos de un minuto. Sin complicaciones.'],
    ['num'=>'02','icon'=>'🔧','color'=>'var(--orange)','bg'=>'#fff3e0','title'=>'Crea tu solicitud',
     'desc'=>'Indica especialidad, fecha, franja horaria, dirección y teléfono de contacto.'],
    ['num'=>'03','icon'=>'⚡','color'=>'#c45f00','bg'=>'#fff8f0','title'=>'Elige la urgencia',
     'desc'=>'Estándar (mínimo 48h) o Urgente (24h). Tú decides según tus necesidades.'],
    ['num'=>'04','icon'=>'👷','color'=>'var(--blue-dark)','bg'=>'var(--blue-dim)','title'=>'Asignamos un técnico',
     'desc'=>'Nuestro administrador asigna un técnico cualificado para tu servicio.'],
    ['num'=>'05','icon'=>'🔑','color'=>'#166534','bg'=>'#dcfce7','title'=>'Recibe tu localizador',
     'desc'=>'Obtendrás un código único tipo REP-2026-XXXX para rastrear tu incidencia.'],
    ['num'=>'06','icon'=>'📊','color'=>'#4a6928','bg'=>'var(--cream)','title'=>'Sigue el estado',
     'desc'=>'En tu panel: Pendiente → Asignada → Finalizada. Siempre informado.'],
  ];
  foreach ($steps as $s): ?>
  <div class="card" style="display:flex;align-items:flex-start;gap:20px;padding:22px 26px;transition:all .2s" onmouseover="this.style.borderColor='<?= $s['color'] ?>'" onmouseout="this.style.borderColor='var(--border)'">
    <div style="flex-shrink:0;width:48px;height:48px;border-radius:14px;background:<?= $s['bg'] ?>;display:flex;align-items:center;justify-content:center;font-size:22px">
      <?= $s['icon'] ?>
    </div>
    <div style="flex:1">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:5px">
        <span style="font-size:11px;font-weight:700;color:<?= $s['color'] ?>;letter-spacing:.06em;text-transform:uppercase">Paso <?= $s['num'] ?></span>
      </div>
      <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:16px;margin-bottom:4px"><?= $s['title'] ?></div>
      <div style="color:var(--muted);font-size:14px"><?= $s['desc'] ?></div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<div style="background:linear-gradient(135deg,var(--cream) 0%,#f0fde4 100%);border:1px solid var(--cream-dk);border-radius:16px;padding:32px;text-align:center">
  <div style="font-size:32px;margin-bottom:12px">🚀</div>
  <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:20px;font-weight:800;color:var(--text);margin-bottom:8px">¿Listo para empezar?</div>
  <p style="color:var(--muted);font-size:15px;margin:0 0 20px">Únete ahora y solicita tu primera reparación gratis.</p>
  <a href="/registro" class="btn btn-primary btn-lg">Crear mi cuenta →</a>
</div>
