<?php use App\Core\Auth; $editing = !empty($inc); ?>
<div style="max-width:760px;margin:0 auto">
  <div style="margin-bottom:22px">
    <span class="chip <?= $editing ? 'chip-blue' : 'chip-orange' ?>"><?= $editing ? 'Editar' : 'Nueva incidencia' ?></span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">
      <?= $editing ? 'Editar incidencia <code style="font-size:16px;background:var(--blue-dim);padding:2px 10px;border-radius:6px;color:var(--blue)">' . htmlspecialchars($inc['localizador']) . '</code>' : 'Nueva incidencia' ?>
    </h1>
  </div>

  <div class="card">
    <form method="post" action="<?= $editing ? '/admin/incidencias/editar' : '/admin/incidencias/nueva' ?>">
      <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
      <?php if ($editing): ?><input type="hidden" name="id" value="<?= $inc['id'] ?>"><?php endif; ?>

      <?php if (!$editing): ?>
      <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Cliente</div>
        <div class="field" style="margin:0">
          <label>Seleccionar cliente</label>
          <select name="cliente_id" required>
            <?php foreach ($clientes as $c): ?>
              <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre'] . ' ' . $c['apellidos']) ?> (<?= $c['email'] ?>)</option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <?php endif; ?>

      <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Tipo de servicio</div>
        <div class="grid grid-2">
          <div class="field">
            <label>Especialidad</label>
            <select name="especialidad_id" required>
              <?php foreach ($especialidades as $e): ?>
                <option value="<?= $e['id'] ?>" <?= ($editing && $inc['especialidad_id']==$e['id'])?'selected':'' ?>>
                  <?= htmlspecialchars($e['nombre_especialidad']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="field">
            <label>Urgencia</label>
            <select name="tipo_urgencia">
              <option value="Estandar" <?= ($editing && $inc['tipo_urgencia']=='Estandar')?'selected':'' ?>>Estándar (48h)</option>
              <option value="Urgente"  <?= ($editing && $inc['tipo_urgencia']=='Urgente')?'selected':'' ?>>Urgente (24h)</option>
            </select>
          </div>
        </div>
      </div>

      <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Fecha y hora</div>
        <div class="grid grid-2">
          <div class="field">
            <label>Fecha y hora</label>
            <input type="datetime-local" name="fecha_servicio" required
                   value="<?= $editing ? str_replace(' ','T',substr($inc['fecha_servicio'],0,16)) : '' ?>">
          </div>
          <div class="field">
            <label>Franja horaria</label>
            <select name="franja_horaria">
              <option value="manana" <?= ($editing && $inc['franja_horaria']=='manana')?'selected':'' ?>>Mañana (9h–14h)</option>
              <option value="tarde"  <?= ($editing && $inc['franja_horaria']=='tarde')?'selected':'' ?>>Tarde (15h–20h)</option>
            </select>
          </div>
        </div>
      </div>

      <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Ubicación y contacto</div>
        <div class="field">
          <label>Dirección</label>
          <input name="direccion" required value="<?= $editing ? htmlspecialchars($inc['direccion']) : '' ?>" placeholder="Calle, número, piso, ciudad">
        </div>
        <div class="field" style="margin-bottom:0">
          <label>Teléfono de contacto</label>
          <input name="telefono_contacto" required value="<?= $editing ? htmlspecialchars($inc['telefono_contacto']) : '' ?>" placeholder="6XX XXX XXX">
        </div>
      </div>

      <div style="margin-bottom:22px">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px">Descripción</div>
        <div class="field" style="margin:0">
          <label>Descripción de la avería</label>
          <textarea name="descripcion" rows="4" required><?= $editing ? htmlspecialchars($inc['descripcion']) : '' ?></textarea>
        </div>
      </div>

      <div class="actions">
        <button class="btn btn-primary btn-lg"><?= $editing ? 'Guardar cambios' : 'Crear incidencia' ?> →</button>
        <a href="/admin/incidencias" class="btn btn-lg">Cancelar</a>
      </div>
    </form>
  </div>
</div>
