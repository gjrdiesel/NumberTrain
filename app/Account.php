<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];

    function trackFollowers(int $count)
    {
        $this->checks()->create(compact('count'));
    }

    function checks()
    {
        return $this->hasMany(Check::class);
    }

    function getLast7DaysAttribute(): array
    {
        // Will eventually return last 7 checks
        return [0, 0, 0, 0, 0, 0, 10];
    }
}
