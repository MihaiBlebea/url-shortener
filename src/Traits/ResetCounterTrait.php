<?php

namespace SerbanBlebea\UrlShortener\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use SerbanBlebea\UrlShortener\Model\Link;
use SerbanBlebea\UrlShortener\ErrorHandlers\ErrorHandler;

trait ResetCounterTrait
{
    public function resetCounter()
    {
        $this->update([
            'count' => 0,
            'reset_date' => Carbon::now(),
        ]);
    }
}
