<?php use App\Core\Auth; ?>
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px">
  <div>
    <span class="chip">Administración</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Usuarios del sistema</h1>
    <p class="muted" style="margin:0;font-size:14px">Gestión de cuentas de clientes, técnicos y administradores.</p>
  </div>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Teléfono</th>
          <th>Rol</th>
          <th>Alta</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
        <tr>
          <td style="font-size:13px;color:var(--muted);font-weight:600">#<?= $u['id'] ?></td>
          <td>
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:32px;height:32px;border-radius:50%;background:var(--surface2);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;color:var(--muted);flex-shrink:0">
                <?= strtoupper(mb_substr($u['nombre'],0,1)) ?>
              </div>
              <span style="font-weight:500"><?= htmlspecialchars($u['nombre'] . ' ' . ($u['apellidos'] ?? '')) ?></span>
            </div>
          </td>
          <td style="font-size:13px;color:var(--muted)"><?= htmlspecialchars($u['email']) ?></td>
          <td style="font-size:13px"><?= htmlspecialchars($u['telefono'] ?? '—') ?></td>
          <td><span class="badge badge-<?= $u['rol'] ?>"><?= $u['rol'] ?></span></td>
          <td style="font-size:12px;color:var(--muted)"><?= htmlspecialchars($u['created_at']) ?></td>
          <td>
            <div class="actions">
              <a href="/admin/usuarios/editar?id=<?= $u['id'] ?>" class="btn btn-sm">Editar</a>
              <form method="post" action="/admin/usuarios/borrar" style="display:inline">
                <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Borrar este usuario?')">Borrar</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
