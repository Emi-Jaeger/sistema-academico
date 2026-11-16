<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Alumno</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-md p-8">
        <h1 class="text-2xl font-bold mb-2">Registrar Nuevo Alumno</h1>
        <p class="text-xs text-slate-500 mb-6">La equivalencia alfabética (NA, SA, DE, AU) se calculará automáticamente.</p>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('alumnos.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nombre completo del alumno</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Contraseña de acceso (mín. 8 caracteres)</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Número de faltas (0 - 50)</label>
                    <input type="number" name="faltas" value="{{ old('faltas', 0) }}" min="0" max="50" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Calificación (0.0 - 10.0)</label>
                    <input type="number" name="calificacion" value="{{ old('calificacion', 0) }}" step="0.1" min="0" max="10" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('alumnos.index') }}"
                    class="bg-slate-200 hover:bg-slate-300 text-slate-800 px-4 py-2 rounded-lg text-sm font-medium">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-semibold">
                    Guardar Alumno
                </button>
            </div>
        </form>
    </div>
</body>
</html>