<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AcademicoController extends Controller
{
    // Vista exclusiva del Alumno (solo consulta su propia información)
    public function miConsulta()
    {
        $alumno = Auth::user();
        return view('alumno-consulta', compact('alumno'));
    }

    // Listado general de alumnos con ordenamiento dinámico (Profesor)
    public function index(Request $request)
    {
        $columnasPermitidas = ['name', 'calificacion', 'faltas'];
        $sort = in_array($request->query('sort'), $columnasPermitidas)
            ? $request->query('sort')
            : 'name';

        $direction = $request->query('direction') === 'desc' ? 'desc' : 'asc';

        $alumnos = User::where('role', 'alumno')
            ->orderBy($sort, $direction)
            ->get();

        return view('alumnos-index', compact('alumnos', 'sort', 'direction'));
    }

    // Formulario de registro de nuevo alumno (Profesor)
    public function create()
    {
        return view('alumnos-create');
    }

    // Guardar nuevo alumno (Profesor)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'faltas' => ['required', 'integer', 'min:0', 'max:50'],
            'calificacion' => ['required', 'numeric', 'min:0', 'max:10'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
            'role' => 'alumno',
            'faltas' => $validated['faltas'],
            'calificacion' => $validated['calificacion'],
        ]);

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno registrado correctamente.');
    }

    // Formulario de edición (Profesor)
    public function edit(User $alumno)
    {
        if (! $alumno->isAlumno()) {
            abort(404);
        }

        return view('alumnos-edit', compact('alumno'));
    }

    // Actualizar datos, faltas y calificación (Profesor)
    public function update(Request $request, User $alumno)
    {
        if (! $alumno->isAlumno()) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($alumno->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'faltas' => ['required', 'integer', 'min:0', 'max:50'],
            'calificacion' => ['required', 'numeric', 'min:0', 'max:10'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'faltas' => $validated['faltas'],
            'calificacion' => $validated['calificacion'],
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $alumno->update($data);

        return redirect()->route('alumnos.index')
            ->with('success', 'Registro académico actualizado correctamente.');
    }

    // Eliminar alumno (Profesor)
    public function destroy(User $alumno)
    {
        if (! $alumno->isAlumno()) {
            abort(403, 'No se puede eliminar una cuenta de profesor.');
        }

        $alumno->delete();

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno eliminado del sistema.');
    }
}