<?php use App\Core\Auth; ?>
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px">
  <div>
    <span class="chip chip-orange">Administración</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Gestión de incidencias</h1>
    <p class="muted" style="margin:0;font-size:14px">Asigna técnicos y gestiona el estado de los avisos.</p>
  </div>
  <div class="actions">
    <a href="/admin/incidencias/nueva" class="btn btn-primary">+ Nueva incidencia</a>
    <a href="/admin/calendario" class="btn">📅 Calendario</a>
  </div>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Localizador</th>
          <th>Cliente</th>
          <th>Servicio</th>
          <th>Fecha</th>
          <th>Urgencia</th>
          <th>Estado</th>
          <th>Técnico asignado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($incs as $i): ?>
        <tr>
          <td>
            <code style="font-size:12px;background:var(--surface2);padding:3px 8px;border-radius:5px;color:var(--blue);font-weight:700">
              <?= htmlspecialchars($i['localizador']) ?>
            </code>
          </td>
          <td style="font-weight:500;font-size:14px"><?= htmlspecialchars($i['cliente_nombre']) ?></td>
          <td style="font-size:14px"><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
          <td style="font-size:13px;color:var(--muted)"><?= htmlspecialchars($i['fecha_servicio']) ?></td>
          <td><span class="badge badge-<?= strtolower($i['tipo_urgencia']) ?>"><?= $i['tipo_urgencia'] ?></span></td>
          <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
          <td>
            <form method="post" action="/admin/incidencias/asignar" style="display:inline-flex;gap:6px">
              <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
              <input type="hidden" name="id" value="<?= $i['id'] ?>">
              <select name="tecnico_id" onchange="this.form.submit()" style="
                font-size:13px;padding:5px 8px;
                background:var(--bg);border:1.5px solid var(--border);
                color:var(--text);border-radius:7px;cursor:pointer;
                font-family:'DM Sans',sans-serif;
              ">
                <option value="">— Sin asignar —</option>
                <?php foreach ($tecs as $t): ?>
                  <option value="<?= $t['id'] ?>" <?= $i['tecnico_id']==$t['id']?'selected':'' ?>>
                    <?= htmlspecialchars($t['nombre_completo']) ?> (<?= $t['nombre_especialidad'] ?>)
                  </option>
                <?php endforeach; ?>
              </select>
            </form>
          </td>
          <td>
            <div class="actions">
              <a href="/admin/incidencias/editar?id=<?= $i['id'] ?>" class="btn btn-sm">Editar</a>
              <form method="post" action="/admin/incidencias/cancelar" style="display:inline">
                <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
                <input type="hidden" name="id" value="<?= $i['id'] ?>">
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Cancelar este aviso?')">Cancelar</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
