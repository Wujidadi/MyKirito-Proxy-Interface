<?php

namespace App\Utilities\Log;

use App\Utilities\Log\Logger;

class Facade
{
    public static function laravel(): Logger
    {
        return new Logger('laravel');
    }

    public static function myKirito(): Logger
    {
        return new Logger('mykirito');
    }
}
