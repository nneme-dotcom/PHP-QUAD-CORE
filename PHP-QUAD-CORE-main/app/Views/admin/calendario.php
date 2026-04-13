<div class="card">
  <h2>Calendario de incidencias</h2>
  <p class="muted">Vistas mensual, semanal y diaria. Verde = Estandar, Rojo = Urgente. Click en un evento para ver detalle.</p>
  <div class="actions" style="margin-bottom:14px">
    <span class="badge badge-estandar">Estandar</span>
    <span class="badge badge-urgente">Urgente</span>
  </div>
  <div id="calendar"></div>
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  const cal = new FullCalendar.Calendar(document.getElementById('calendar'), {
    initialView: 'dayGridMonth',
    locale: 'es',
    firstDay: 1,
    headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay' },
    events: '/admin/api/eventos',
    eventClick: function(info){
      const p = info.event.extendedProps;
      alert(
        info.event.title + '\n' +
        'Estado: ' + p.estado + '\n' +
        'Cliente: ' + (p.cliente||'-') + '\n' +
        'Tecnico: ' + (p.tecnico||'-')
      );
    }
  });
  cal.render();
});
</script>
