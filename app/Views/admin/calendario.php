<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px">
  <div>
    <span class="chip chip-orange">Administración</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Calendario de incidencias</h1>
    <p class="muted" style="margin:0;font-size:14px">Vista mensual, semanal y diaria. Haz clic en un evento para ver el detalle.</p>
  </div>
  <div style="display:flex;gap:10px;align-items:center">
    <span class="badge badge-estandar">Estándar</span>
    <span class="badge badge-urgente">Urgente</span>
  </div>
</div>

<div class="card" style="padding:24px">
  <div id="calendar"></div>
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<style>
/* Override FullCalendar to match ReparaYa palette */
.fc .fc-toolbar-title{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:18px;color:var(--text)}
.fc .fc-button-primary{
  background:var(--blue)!important;border-color:var(--blue)!important;
  font-family:'DM Sans',sans-serif;font-weight:600;font-size:13px;
}
.fc .fc-button-primary:hover{background:var(--blue-dark)!important;border-color:var(--blue-dark)!important}
.fc .fc-button-primary:not(:disabled).fc-button-active{background:var(--blue-dark)!important}
.fc-daygrid-day-number,.fc-col-header-cell-cushion{color:var(--text)!important;font-family:'DM Sans',sans-serif;font-size:13px}
.fc-day-today{background:#f0f7ff!important}
.fc-event{border-radius:5px!important;border:none!important;font-size:12px!important;font-weight:600!important;padding:2px 6px!important;cursor:pointer}
</style>
<script>
document.addEventListener('DOMContentLoaded', function(){
  const cal = new FullCalendar.Calendar(document.getElementById('calendar'), {
    initialView: 'dayGridMonth',
    locale: 'es',
    firstDay: 1,
    height: 'auto',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: '/admin/api/eventos',
    eventDidMount: function(info){
      const urgencia = info.event.extendedProps.urgencia;
      if(urgencia === 'Urgente'){
        info.el.style.background = '#fff3e0';
        info.el.style.color = '#c45f00';
      } else {
        info.el.style.background = '#E9F7CA';
        info.el.style.color = '#4a6928';
      }
    },
    eventClick: function(info){
      const p = info.event.extendedProps;
      const msg = [
        '📋 ' + info.event.title,
        '',
        '🔹 Estado: ' + (p.estado || '—'),
        '👤 Cliente: ' + (p.cliente || '—'),
        '🔧 Técnico: ' + (p.tecnico || 'Sin asignar'),
      ].join('\n');
      alert(msg);
    }
  });
  cal.render();
});
</script>
