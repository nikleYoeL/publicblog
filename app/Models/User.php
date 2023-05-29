<?php

namespace App\Models;

use App\Traits\Avatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, 
        HasRoles,
        Notifiable,
        Avatar;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    private function block(): bool
    {
        $this->blocked = true;
        
        return $this->save();
    }

    private function unblock(): bool
    {
        $this->blocked = false;

        return $this->save();
    }
    
    public function isBlocked(): bool
    {
        return $this->blocked;
    }

    public function changeBlockingStatus(): void
    {
        if ($this->isBlocked() == false) {
            $this->block();
        } else {
            $this->unblock();
        }
    }

    public function isVerified():bool
    {
        if ($this->email_verified_at) {
            return true;
        }

        return false;
    }
}
