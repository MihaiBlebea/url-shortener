<?php

namespace SerbanBlebea\UrlShortener\Model;

use SerbanBlebea\UrlShortener\Traits\ResetCounterTrait as Reset;
use SerbanBlebea\UrlShortener\Traits\ChangeUniqueIdTrait as Change;
use Illuminate\Database\Eloquent\Model;
use SerbanBlebea\UrlShortener\Helpers\ConstructDestinationLinkHelper as Construct;
use Illuminate\Support\Facades\URL;

class Link extends Model
{
    use Reset, Change;

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

    public function getShortUrl()
    {
        if($this->campaign == null && $this->medium == null && $this->source == null) 
        {
            return $this->destination_link;
        } else {
            $destination_link = Construct::urlWithParams($this->destination_link, $this->campaign, $this->medium, $this->source);
            return $destination_link;
        }
    }

    public function create_short_url()
    {
        $base_url = URL::to('/');

        return $base_url . '/s/' . $this->unique_id;
    }
}
