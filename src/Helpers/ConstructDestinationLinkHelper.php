<?php

namespace SerbanBlebea\UrlShortener\Helpers;

class ConstructDestinationLinkHelper
{
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
}