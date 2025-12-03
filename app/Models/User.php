<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'numero_control',
        'password',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Verificar si el usuario es administrador
     */
    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    /**
     * Verificar si el usuario es maestro (asesor)
     */
    public function isMaestro()
    {
        return $this->user_type === 'maestro';
    }

    /**
     * Verificar si el usuario es juez
     */
    public function isJuez()
    {
        return $this->user_type === 'juez';
    }

    /**
     * Verificar si el usuario es estudiante
     */
    public function isEstudiante()
    {
        return $this->user_type === 'estudiante';
    }

    /**
     * Verificar si el usuario es asesor (maestro)
     */
    public function isAsesor()
    {
        return $this->user_type === 'maestro';
    }

    /**
     * Verificar si el usuario es docente (alias de isMaestro)
     */
    public function isDocente()
    {
        return $this->isMaestro();
    }

    /**
     * Obtener el nombre del rol formateado
     */
    public function getRoleName()
    {
        return match($this->user_type) {
            'admin' => 'Administrador',
            'maestro' => 'Maestro (Asesor)',
            'juez' => 'Juez',
            'estudiante' => 'Estudiante',
            default => 'Usuario',
        };
    }

    /**
     * Obtener el color del badge según el rol
     */
    public function getRoleBadgeClass()
    {
        return match($this->user_type) {
            'admin' => 'bg-red-100 text-red-800',
            'maestro' => 'bg-green-100 text-green-800',
            'juez' => 'bg-purple-100 text-purple-800',
            'estudiante' => 'bg-blue-100 text-blue-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
