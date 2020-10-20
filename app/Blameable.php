<?php

namespace App;

use App\Observers\UserObserver;

trait Blameable
{
    public static function bootBlameable()
    {
        static::observe(UserObserver::class);
    }
}