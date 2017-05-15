<?php

namespace SerbanBlebea\UrlShortener\Traits;

use Illuminate\Database\Eloquent\Model;
use SerbanBlebea\UrlShortener\Model\Link;
use SerbanBlebea\UrlShortener\ErrorHandlers\ErrorHandler;

trait ChangeUniqueIdTrait
{
    public function changeUniqueId($newUniqueId)
    {
        $links = Link::all();

        foreach($links as $link)
        {
            if($link->unique_id == $newUniqueId)
            {
                return ErrorHandler::newUniqueIdNotUnique();
            }
        }

        $this->update([
            'unique_id' => $newUniqueId
        ]);
    }
}
