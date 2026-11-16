<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'faltas',
        'calificacion',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'faltas' => 'integer',
            'calificacion' => 'float',
        ];
    }

    public function isProfesor(): bool
    {
        return $this->role === 'profesor';
    }

    public function isAlumno(): bool
    {
        return $this->role === 'alumno';
    }

    // Cálculo automático de equivalencia alfabética (se accede como $user->equivalencia)
    public function getEquivalenciaAttribute(): string
    {
        $nota = (float) $this->calificacion;

        if ($nota >= 9.0) {
            return 'AU'; // Autónomo
        } elseif ($nota >= 8.0) {
            return 'DE'; // Destacado
        } elseif ($nota >= 7.0) {
            return 'SA'; // Suficiente
        }

        return 'NA'; // No Acreditado (< 7.0)
    }
}