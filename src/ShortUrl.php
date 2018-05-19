<?php

namespace SerbanBlebea\UrlShortener;

use SerbanBlebea\UrlShortener\Model\Link;
use SerbanBlebea\UrlShortener\ErrorHandlers\ErrorHandler;

class ShortUrl
{
    /**
     * Function that create the short url
     *
     * @param string $name the name of the url
     * @param string $destination_link the url to point the short ulr to
     * @param string $campaign = null optional
     * @param string $source = null optional
     * @param string $medium = null optional
     *
     * @return string $short_url
     */

    public static function shortenUrl($name, $destination_link, $campaign = null, $source = null, $medium = null)
    {
        $links = Link::all();
        foreach($links as $link)
        {
            if($link->name === $name)
            {
                return ErrorHandler::notUniqueName();
            }

            if($link->destination_link === $destination_link)
            {
                return ErrorHandler::destinationUrlExists($link->getShortUrl());
            }
        }

        if(filter_var(url($destination_link), FILTER_VALIDATE_URL) == false)
        {
            return ErrorHandler::notValidUrl();
        }

        $unique_id = self::generateUniqueId();

        $short_url = Link::create([
            'name' => $name,
            'unique_id' => $unique_id,
            'destination_link' => $destination_link,
            'campaign' => $campaign,
            'source' => $source,
            'medium' => $medium,
        ]);
        
        return $short_url;
    }

    /**
     * Funtion that return the unique_id for the shorten url
     *
     * @return string
     */

    public static function generateUniqueId()
    {
        $string = str_random(8);
        $link = Link::where('unique_id', $string)->first();

        if($link)
        {
            self::generateUniqueId();
        }

        return $string;
    }

    /**
     * Funtion that eturn the url with GTM params
     *
     * @param string $destination_link
     * @param string $campaign
     * @param string $medium
     * @param string $source
     *
     * @return string final url with query params
     */

    public static function urlWithParams($destination_link, $campaign = null, $medium = null, $source = null)
    {
        $urlParams = '';

        if($campaign !== '')
        {
            $urlParams = 'campaign=' . $campaign . '&';
        }

        if($medium !== '')
        {
            $urlParams = $urlParams . 'medium=' . $medium . '&';
        }

        if($source !== '')
        {
            $urlParams =  $urlParams . 'source=' . $source;
        }

        substr($urlParams, 0, -1);

        return $destination_link . '?' . $urlParams;
    }

    public function changeUniqueId(String $old_id, String $new_id)
    {
        $link = Link::where('unique_id', $old_id)->update([
            'unique_id' => $new_id,
            'count' => 0
        ]);

        return $link->getShortUrl();
    }

    public function get(String $name)
    {
        return Link::where('name', $name)->first();
    }

    public function count(String $name)
    {
        $link = Link::where('name', $name)->first();
        if($link)
        {
            return $link->count;
        }
        return ErrorHandler::linkNotInDatabase();
    }
}
