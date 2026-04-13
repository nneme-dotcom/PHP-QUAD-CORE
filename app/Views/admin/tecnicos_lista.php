<?php use App\Core\Auth; ?>
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px">
  <div>
    <span class="chip chip-blue">Administración</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Maestro de técnicos</h1>
    <p class="muted" style="margin:0;font-size:14px">Gestiona los profesionales de la red ReparaYa.</p>
  </div>
  <a href="/admin/tecnicos/nuevo" class="btn btn-primary">+ Nuevo técnico</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Especialidad</th>
          <th>Email login</th>
          <th>Disponible</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tecs as $t): ?>
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:34px;height:34px;border-radius:50%;background:var(--blue-dim);display:flex;align-items:center;justify-content:center;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:13px;color:var(--blue);flex-shrink:0">
                <?= strtoupper(mb_substr($t['nombre_completo'],0,1)) ?>
              </div>
              <span style="font-weight:600"><?= htmlspecialchars($t['nombre_completo']) ?></span>
            </div>
          </td>
          <td>
            <?php if ($t['nombre_especialidad'] ?? null): ?>
              <span class="chip chip-blue" style="font-size:11px"><?= htmlspecialchars($t['nombre_especialidad']) ?></span>
            <?php else: ?>
              <span class="muted" style="font-size:13px">—</span>
            <?php endif; ?>
          </td>
          <td style="font-size:13px;color:var(--muted)"><?= htmlspecialchars($t['email'] ?? '—') ?></td>
          <td>
            <?php if ($t['disponible']): ?>
              <span class="badge badge-finalizada">Disponible</span>
            <?php else: ?>
              <span class="badge badge-cancelada">No disponible</span>
            <?php endif; ?>
          </td>
          <td>
            <div class="actions">
              <a href="/admin/tecnicos/editar?id=<?= $t['id'] ?>" class="btn btn-sm">Editar</a>
              <form method="post" action="/admin/tecnicos/borrar" style="display:inline">
                <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Borrar este técnico?')">Borrar</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
