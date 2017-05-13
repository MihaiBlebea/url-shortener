<?php

namespace SerbanBlebea\UrlShortener\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SerbanBlebea\UrlShortener\Model\Link;
use SerbanBlebea\UrlShortener\Helpers\ConstructDestinationLinkHelper as Construct;

class LinkController extends Controller
{
    public function index($link)
    {
        $short_link = Link::where('unique_id', $link)->first();
        
        if($short_link->count() == 0)
        {
            dd('Could not access link');
        }
    
        $count = $short_link->count;
        $short_link->update([
            'count' => $count + 1,
        ]);

        if($short_link->campaign == null && $short_link->medium == null && $short_link->source == null) 
        {
            return redirect($short_link->destination_link);
        } else {
            $destination_link = Construct::urlWithParams($short_link->destination_link, $short_link->campaign, $short_link->medium, $short_link->source);
            return redirect($destination_link);
        }
        
    }
}
