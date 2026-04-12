<?php use App\Core\Auth; ?>
<div class="card" style="max-width:680px;margin:20px auto">
  <h2>Nueva solicitud</h2>
  <?php if (!empty($error)): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <div class="alert alert-info">
    <strong>Importante:</strong> Las solicitudes <em>Estandar</em> deben pedirse con minimo <strong>48h de antelacion</strong>.
    Las <em>Urgentes</em> se atienden en 24h.
  </div>
  <form method="post" action="/cliente/avisos/nuevo">
    <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
    <div class="grid grid-2">
      <div class="field"><label>Especialidad</label>
        <select name="especialidad_id" required>
          <?php foreach ($especialidades as $e): ?>
          <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['nombre_especialidad']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="field"><label>Tipo de servicio</label>
        <select name="tipo_urgencia">
          <option value="Estandar">Estandar (48h)</option>
          <option value="Urgente">Urgente (24h)</option>
        </select>
      </div>
    </div>
    <div class="grid grid-2">
      <div class="field"><label>Fecha y hora</label><input type="datetime-local" name="fecha_servicio" required></div>
      <div class="field"><label>Franja horaria</label>
        <select name="franja_horaria"><option value="manana">Manana</option><option value="tarde">Tarde</option></select>
      </div>
    </div>
    <div class="field"><label>Direccion</label><input name="direccion" required></div>
    <div class="field"><label>Telefono de contacto</label><input name="telefono_contacto" required></div>
    <div class="field"><label>Descripcion de la averia</label><textarea name="descripcion" rows="4" required></textarea></div>
    <button class="btn btn-primary">Crear solicitud</button>
    <a href="/cliente/avisos" class="btn">Cancelar</a>
  </form>
</div>
