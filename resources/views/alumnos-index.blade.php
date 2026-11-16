<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Académica - Profesor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        <x-navbar />

        @if (session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-r-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Barra de filtros y ordenamiento -->
        <div class="bg-white rounded-xl shadow-sm p-4 mb-6 flex flex-wrap items-center justify-between gap-4">
            <span class="text-sm font-semibold text-slate-700">Ordenar listado por:</span>

            <div class="flex flex-wrap gap-2 text-xs font-medium">
                <!-- a) Alfabéticamente por nombre -->
                <a href="{{ route('alumnos.index', ['sort' => 'name', 'direction' => ($sort === 'name' && $direction === 'asc') ? 'desc' : 'asc']) }}"
                    class="px-3 py-2 rounded-lg border {{ $sort === 'name' ? 'bg-blue-50 border-blue-500 text-blue-700' : 'bg-slate-50 border-slate-300 text-slate-700' }}">
                    Nombre {{ $sort === 'name' ? ($direction === 'asc' ? '↑ (A-Z)' : '↓ (Z-A)') : '(A-Z)' }}
                </a>

                <!-- b) Por calificación -->
                <a href="{{ route('alumnos.index', ['sort' => 'calificacion', 'direction' => ($sort === 'calificacion' && $direction === 'desc') ? 'asc' : 'desc']) }}"
                    class="px-3 py-2 rounded-lg border {{ $sort === 'calificacion' ? 'bg-blue-50 border-blue-500 text-blue-700' : 'bg-slate-50 border-slate-300 text-slate-700' }}">
                    Calificación {{ $sort === 'calificacion' ? ($direction === 'desc' ? '↓ (Mayor a menor)' : '↑ (Menor a mayor)') : '' }}
                </a>

                <!-- c) Por número de faltas -->
                <a href="{{ route('alumnos.index', ['sort' => 'faltas', 'direction' => ($sort === 'faltas' && $direction === 'desc') ? 'asc' : 'desc']) }}"
                    class="px-3 py-2 rounded-lg border {{ $sort === 'faltas' ? 'bg-blue-50 border-blue-500 text-blue-700' : 'bg-slate-50 border-slate-300 text-slate-700' }}">
                    Faltas {{ $sort === 'faltas' ? ($direction === 'desc' ? '↓ (Mayor a menor)' : '↑ (Menor a mayor)') : '' }}
                </a>
            </div>
        </div>

        <!-- Tabla académica -->
        <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-600">
                        <th class="py-3 px-4">Nombre del Alumno</th>
                        <th class="py-3 px-4">Correo</th>
                        <th class="py-3 px-4 text-center">Número de Faltas</th>
                        <th class="py-3 px-4 text-center">Calificación</th>
                        <th class="py-3 px-4 text-center">Equivalencia</th>
                        <th class="py-3 px-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm">
                    @forelse ($alumnos as $alumno)
                        <tr class="hover:bg-slate-50">
                            <td class="py-3 px-4 font-medium">{{ $alumno->name }}</td>
                            <td class="py-3 px-4 text-slate-500">{{ $alumno->email }}</td>
                            <td class="py-3 px-4 text-center font-mono">{{ $alumno->faltas }}</td>
                            <td class="py-3 px-4 text-center font-mono font-bold">
                                {{ number_format($alumno->calificacion, 2) }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <x-badge-equivalencia :tipo="$alumno->equivalencia" />
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('alumnos.edit', $alumno->id) }}"
                                        class="bg-amber-100 hover:bg-amber-200 text-amber-800 px-3 py-1 rounded text-xs font-medium">
                                        Editar
                                    </a>

                                    <form method="POST" action="{{ route('alumnos.destroy', $alumno->id) }}"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este registro académico?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-medium">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-slate-500">
                                No hay alumnos registrados en el sistema.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>