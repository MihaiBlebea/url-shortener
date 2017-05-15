<?php

namespace SerbanBlebea\UrlShortener\ErrorHandlers;

class ErrorHandler 
{
    public static function notUniqueName()
    {    
        return 'The selected name for the short url is not unique';
    }

    public static function notValidUrl()
    {
        return 'Your destination link is not a valid url';
    }

    public static function linkNotInDatabase()
    {
        return 'Your selected link is not present in database';
    }

    public static function newUniqueIdNotUnique()
    {
        return 'The new unique id is already in use';
    }
}
