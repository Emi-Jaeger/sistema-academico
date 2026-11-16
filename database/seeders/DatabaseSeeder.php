<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Prof. Kenneth',
            'email' => 'profesor@sistema.com',
            'password' => Hash::make('Profesor1234!'),
            'role' => 'profesor',
            'faltas' => 0,
            'calificacion' => 0,
        ]);

        User::create([
            'name' => 'Joshue Angel',
            'email' => 'joshue@sistema.com',
            'password' => Hash::make('Alumno1234!'),
            'role' => 'alumno',
            'faltas' => 1,
            'calificacion' => 9.5, // AU
        ]);

        User::create([
            'name' => 'Emiliano Laravel',
            'email' => 'lara@sistema.com',
            'password' => Hash::make('Alumno1234!'),
            'role' => 'alumno',
            'faltas' => 3,
            'calificacion' => 8.4, // DE
        ]);

        User::create([
            'name' => 'Carlos Daniel',
            'email' => 'daniel@sistema.com',
            'password' => Hash::make('Alumno1234!'),
            'role' => 'alumno',
            'faltas' => 2,
            'calificacion' => 7.2, // SA
        ]);

        User::create([
            'name' => 'Emiliano Cuevas',
            'email' => 'emiliano@sistema.com',
            'password' => Hash::make('Alumno1234!'),
            'role' => 'alumno',
            'faltas' => 6,
            'calificacion' => 5.8, // NA
        ]);
    }
}