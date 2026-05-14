@php
    $config = [
        'Pendiente'  => ['bg' => 'warning',   'text' => 'dark',  'icon' => 'bi-clock'],
        'Asignada'   => ['bg' => 'primary',   'text' => 'white', 'icon' => 'bi-person-check'],
        'Finalizada' => ['bg' => 'success',   'text' => 'white', 'icon' => 'bi-check-circle'],
        'Cancelada'  => ['bg' => 'secondary', 'text' => 'white', 'icon' => 'bi-x-circle'],
    ];
    $c = $config[$estado] ?? ['bg' => 'light', 'text' => 'dark', 'icon' => 'bi-question'];
@endphp
<span class="badge bg-{{ $c['bg'] }} text-{{ $c['text'] }}">
    <i class="bi {{ $c['icon'] }}"></i> {{ $estado }}
</span>
