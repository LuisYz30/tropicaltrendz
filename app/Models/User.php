<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'telefono',
        'direccion',
        'email',
        'password',
        'rol',
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
            'is_admin' => 'boolean',
        ];
    }
       /**
     * Verifica si el usuario es administrador
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Relación con facturas (ejemplo - ajustar según tu DB)
     */
    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function reseñas()
    {
        return $this->hasMany(Reseña::class);
    }
}