<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'solde', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    // ✅ Un seul $casts, pas de méthode casts()
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'solde' => 'integer',   // ← integer avec un 'r' pas integre !
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}