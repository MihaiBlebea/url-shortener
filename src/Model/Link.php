<?php

namespace SerbanBlebea\UrlShortener\Model;

use Illuminate\Database\Eloquent\Model;
use SerbanBlebea\UrlShortener\ShortUrl;
use Illuminate\Support\Facades\URL;

class Link extends Model
{
    protected $fillable = [
        'name',
        'unique_id',
        'destination_link',
        'count',
        'campaign',
        'source',
        'medium',
        'reset_date',
    ];

    public function getRouteKeyName()
    {
        return 'unique_id';
    }

    public function getDestinationUrl()
    {
        if($this->campaign == null && $this->medium == null && $this->source == null)
        {
            return $this->destination_link;
        } else {
            $destination_link = ShortUrl::urlWithParams($this->destination_link, $this->campaign, $this->medium, $this->source);
            return $destination_link;
        }
    }

    public function getShortUrl(String $unique_id = null)
    {
        $id = ($unique_id == null) ? $this->unique_id : $unique_id;
        return URL::to('/') . '/' . config('url-shortener.special_route_param') . '/' . $id;
    }

    public function resetCounter()
    {
        $this->update([
            'count' => 0,
            'reset_date' => Carbon::now(),
        ]);
    }

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

        return true;
    }
}
