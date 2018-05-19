<?php

namespace SerbanBlebea\UrlShortener\Facades;

use Illuminate\Support\Facades\Facade;

class ShortUrl extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'ShortUrl';
    }
}
