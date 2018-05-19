<?php

namespace SerbanBlebea\UrlShortener\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SerbanBlebea\UrlShortener\Model\Link;
use SerbanBlebea\UrlShortener\Helpers\ConstructDestinationLinkHelper as Construct;
use SerbanBlebea\UrlShortener\ErrorHandlers\ErrorHandler;

class LinkController extends Controller
{
    public function index($link)
    {
        $short_link = Link::where('unique_id', $link)->first();

        if($short_link->count() == 0)
        {
            return ErrorHandler::linkNotInDatabase();
        }

        $count = $short_link->count;
        $short_link->update([
            'count' => $count + 1,
        ]);

        $destination_link = $short_link->getDestinationUrl();
        return redirect($destination_link);
    }
}
