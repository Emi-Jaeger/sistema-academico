<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Información Académica</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen p-6">
    <div class="max-w-3xl mx-auto">
        <x-navbar />

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-200">
                <h2 class="text-lg font-bold">Boleta de Calificaciones</h2>
                <p class="text-sm text-slate-500">Consulta individual de rendimiento académico.</p>
            </div>

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-600">
                        <th class="py-3 px-4">Nombre del Alumno</th>
                        <th class="py-3 px-4 text-center">Número de Faltas</th>
                        <th class="py-3 px-4 text-center">Calificación Numérica</th>
                        <th class="py-3 px-4 text-center">Equivalencia Alfabética</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr>
                        <td class="py-4 px-4 font-semibold">{{ $alumno->name }}</td>
                        <td class="py-4 px-4 text-center font-mono">{{ $alumno->faltas }}</td>
                        <td class="py-4 px-4 text-center font-mono font-bold text-base">
                            {{ number_format($alumno->calificacion, 2) }}
                        </td>
                        <td class="py-4 px-4 text-center">
                            <x-badge-equivalencia :tipo="$alumno->equivalencia" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>