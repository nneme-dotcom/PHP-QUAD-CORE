<?php use App\Core\Auth; $editing = !empty($tec); ?>
<div style="max-width:620px;margin:0 auto">
  <div style="margin-bottom:22px">
    <span class="chip chip-blue">Técnicos</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px"><?= $editing ? 'Editar técnico' : 'Nuevo técnico' ?></h1>
  </div>

  <div class="card">
    <form method="post" action="<?= $editing ? '/admin/tecnicos/editar' : '/admin/tecnicos/nuevo' ?>">
      <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
      <?php if ($editing): ?><input type="hidden" name="id" value="<?= $tec['id'] ?>"><?php endif; ?>

      <div class="field">
        <label>Nombre completo</label>
        <input name="nombre_completo" required value="<?= $editing ? htmlspecialchars($tec['nombre_completo']) : '' ?>" placeholder="Nombre y apellidos">
      </div>

      <div class="field">
        <label>Especialidad</label>
        <select name="especialidad_id" required>
          <?php foreach ($especialidades as $e): ?>
            <option value="<?= $e['id'] ?>" <?= ($editing && $tec['especialidad_id']==$e['id'])?'selected':'' ?>>
              <?= htmlspecialchars($e['nombre_especialidad']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="field">
        <label>Usuario de login <span style="font-weight:400;font-size:12px">(opcional)</span></label>
        <select name="usuario_id">
          <option value="">— Sin login asociado —</option>
          <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id'] ?>" <?= ($editing && $tec['usuario_id']==$u['id'])?'selected':'' ?>>
              <?= htmlspecialchars($u['nombre'] . ' (' . $u['email'] . ')') ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div style="padding:14px;background:var(--surface2);border:1px solid var(--border);border-radius:var(--radius-sm);margin-bottom:18px">
        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-size:15px;font-weight:500">
          <input type="checkbox" name="disponible" value="1"
            <?= (!$editing || !empty($tec['disponible'])) ? 'checked' : '' ?>
            style="width:18px;height:18px;accent-color:var(--blue)">
          Técnico disponible
        </label>
      </div>

      <div class="actions">
        <button class="btn btn-primary btn-lg"><?= $editing ? 'Guardar cambios' : 'Crear técnico' ?> →</button>
        <a href="/admin/tecnicos" class="btn btn-lg">Cancelar</a>
      </div>
    </form>
  </div>
</div>
