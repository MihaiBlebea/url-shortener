<?php

namespace SerbanBlebea\UrlShortener\ErrorHandlers;

class ErrorHandler
{
   public static function notUniqueName()
   {
        dd('The selected name for the short url is not unique');
   }

   public static function notValidUrl()
   {
        dd('Your destination link is not a valid url');
   }
}
