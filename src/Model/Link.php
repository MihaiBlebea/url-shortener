<?php

namespace SerbanBlebea\UrlShortener\Model;

use SerbanBlebea\UrlShortener\Traits\ResetCounterTrait as Reset;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use Reset;

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
}
