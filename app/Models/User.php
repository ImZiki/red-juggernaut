<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Billable;

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin() || $this->isSuperAdmin();
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    /**
     * Atributos asignables
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Atributos ocultos para serialización
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    /**
     * Atributos que tienen que ser casteados
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
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

// Añadir rol de administrador
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    public function isSuperAdmin():bool
    {
        return $this->role === 'superadmin';
    }


}
