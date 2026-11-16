@props(['tipo'])

@php
    $estilos = match($tipo) {
        'AU' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
        'DE' => 'bg-blue-100 text-blue-800 border-blue-300',
        'SA' => 'bg-amber-100 text-amber-800 border-amber-300',
        default => 'bg-red-100 text-red-800 border-red-300',
    };

    $descripcion = match($tipo) {
        'AU' => 'AU - Autónomo',
        'DE' => 'DE - Destacado',
        'SA' => 'SA - Suficiente',
        default => 'NA - No Acreditado',
    };
@endphp

<span class="inline-block px-3 py-1 rounded-full text-xs font-bold border {{ $estilos }}">
    {{ $descripcion }}
</span>