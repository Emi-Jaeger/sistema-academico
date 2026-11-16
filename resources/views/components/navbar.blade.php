<<div class="bg-white rounded-xl shadow-sm p-4 mb-6 flex flex-wrap justify-between items-center gap-4">
    <div>
        <h1 class="text-xl font-bold text-slate-800">Sistema Académico</h1>
        <p class="text-sm text-slate-500">
            Usuario: <strong>{{ auth()->user()->name }}</strong>
            (<span class="uppercase font-semibold {{ auth()->user()->isProfesor() ? 'text-purple-600' : 'text-blue-600' }}">{{ auth()->user()->role }}</span>)
        </p>
    </div>

    <div class="flex items-center gap-3">
        @if (auth()->user()->isProfesor())
            <a href="{{ route('alumnos.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                + Registrar Alumno
            </a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-slate-200 hover:bg-slate-300 text-slate-800 text-sm font-medium px-4 py-2 rounded-lg transition">
                Cerrar Sesión
            </button>
        </form>
    </div>
</div>