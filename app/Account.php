<?php

namespace App;

use Facades\App\Accounts\Twitter;
use Illuminate\Database\Eloquent\Model;
use Facades\App\Accounts\YouTube\Channel;

class Account extends Model
{
    protected $guarded = [];

    static $types = [
        Channel::class,
        Twitter::class
    ];

    static function cleanName($type)
    {
        $namespace = str_after($type, 'Facades\App\Accounts\\');
        return str_replace('\\', ' ', $namespace);
    }

    static function getTypes()
    {
        return collect(self::$types)->map(function ($type) {
            return [
                'name' => self::cleanName($type),
                'value' => $type
            ];
        });
    }

    function getTypeAttribute()
    {
        return self::cleanName($this->attributes['type']);
    }

    function fetch()
    {
        $this->attributes['type']::fetch($this);
    }

    function track(int $count, string $name)
    {
        $this->checks()->create(compact('count', 'name'));
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

    function getTotalFollowersAttribute(): int
    {
        return $this->checks()->latest()->first()->count ?? 0;
    }

}
