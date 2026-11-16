<?php

use App\Http\Controllers\AcademicoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Ruta exclusiva para el Alumno (solo lectura de su propio registro)
    Route::middleware('role:alumno')->group(function () {
        Route::get('/mi-calificacion', [AcademicoController::class, 'miConsulta'])->name('alumno.consulta');
    });

    // Rutas exclusivas para el Profesor (CRUD completo y ordenamiento)
    Route::middleware('role:profesor')->group(function () {
        Route::get('/alumnos', [AcademicoController::class, 'index'])->name('alumnos.index');
        Route::get('/alumnos/crear', [AcademicoController::class, 'create'])->name('alumnos.create');
        Route::post('/alumnos', [AcademicoController::class, 'store'])->name('alumnos.store');
        Route::get('/alumnos/{alumno}/editar', [AcademicoController::class, 'edit'])->name('alumnos.edit');
        Route::put('/alumnos/{alumno}', [AcademicoController::class, 'update'])->name('alumnos.update');
        Route::delete('/alumnos/{alumno}', [AcademicoController::class, 'destroy'])->name('alumnos.destroy');
    });
});