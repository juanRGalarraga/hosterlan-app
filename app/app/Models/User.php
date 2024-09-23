<?php

namespace App\Models;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Guest;
use App\Models\Owner;
use App\Models\Publication;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_confirmation',
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
        'password' => 'hashed',
    ];

    public function isOwner(){
        return is_a($this->owner, Owner::class) ?: false;
    }

    public function isGuest(){
        return is_a($this->guest, Guest::class) ?: false;
    }

    public function publications(){
        return $this->hasMany(Publication::class);
    }

    public function owner(){
        return $this->hasOne(Owner::class);
    }
    
    public function guest(){
        return $this->hasOne(Guest::class);
    }

    public function phones() : HasMany {
        return $this->hasMany(Phone::class);
    }
}
