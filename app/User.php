<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function addAccount(array $data): Account
    {
        return $this->accounts()->create($data);
    }

    function getTotalFollowersAttribute(): int
    {
        return 10;
    }

    function getLast7DaysAttribute(): array
    {
        return [0, 0, 0, 0, 0, 0, 10];
    }

    function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
