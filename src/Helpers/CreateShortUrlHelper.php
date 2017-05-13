<?php

namespace SerbanBlebea\UrlShortener\Helpers;

use Illuminate\Database\Eloquent\Model;
use SerbanBlebea\UrlShortener\Model\Link;
use SerbanBlebea\UrlShortener\ErrorHandlers\ErrorHandler;

class CreateShortUrlHelper
{
    public function shortenUrl($name, $destination_link, $campaign = null, $source = null, $medium = null) 
    {   
        $links = Link::all();
        foreach($links as $link) 
        {
            if($link->name == $name)
            {
                return ErrorHandler::notUniqueName();
            }
        }

        if(filter_var($destination_link, FILTER_VALIDATE_URL) === false)
        {
            return ErrorHandler::notValidUrl();
        }

        Link::create([
            'name' => $name,
            'unique_id' => $this->unique_id(),
            'destination_link' => $destination_link,
            'campaign' => $campaign,
            'source' => $source,
            'medium' => $medium,
        ]);
    }

    public function unique_id()
    {
        $string = str_random(8);
        $links = Link::all();

        if($links->contains($string)) {
            $string = str_random(8);
        } else {
            return $string;
        }
    }
}
