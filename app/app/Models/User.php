<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function alcoholStrength(): HasOne
    {
        return $this->hasOne(UserAlcoholStrengths::class);
    }

    public function sodaPreference(): HasOne
    {
        return $this->hasOne(UserSodaPreference::class);
    }

    public function alcoholPreference()
    {
        return $this->hasMany(UserAlcoholPreference::class, 'user_id');
    }

    public function friend()
    {
        return $this->hasMany(Friend::class, 'user_id');
    }

    public function favoriteDrinks()
    {
        return $this->hasMany(FavoriteDrink::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    public function isFollowing($userId)
    {
        return $this->friends()->where('friend_id', $userId)->exists();
    }

    public function bio()
    {
        return $this->hasOne(UserBio::class);
    }
}
