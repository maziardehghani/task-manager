<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'password' => 'hashed',
        ];
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }


    public function scopeWhereEmail($query, string $email)
    {
        return $query->where('email', $email);
    }


    public function signIn(): string
    {
        $this->tokens()->delete();

        return $this->createToken(
            name: 'task-manager-api',
            expiresAt: now()->addDay()
        )->plainTextToken;
    }


    public function signUp(): string
    {
        return $this->createToken(
            name: 'task-manager-api',
            expiresAt: now()->addDay()
        )->plainTextToken;
    }


    public function logout(): void
    {
        $this->tokens()->delete();
    }

}
