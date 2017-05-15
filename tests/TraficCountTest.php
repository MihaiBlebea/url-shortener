<?php

use SerbanBlebea\UrlShortener\Helpers\CreateShortUrlHelper as CreateUrl;
use SerbanBlebea\UrlShortener\Model\Link;
use SerbanBlebea\UrlShortener\Controllers\LinkController;

class TraficCountTest extends TestCase
{
    public function test_new_url_has_traffic_zero()
    {
        $url = new CreateUrl;
        $url->shortenUrl('home', 'http://www.fengshuiarmonie.ro');

        $url = Link::where('name', 'home')->first();

        $this->assertEquals(0, $url->count);
    }

    public function test_reset_traffic_count()
    {
        $url = new CreateUrl;
        $url->shortenUrl('home', 'http://www.fengshuiarmonie.ro');

        $url = Link::where('name', 'home')->first();

        $url->update([
            'count' => 25
        ]);

        $this->assertEquals(25, $url->count);

        $url->resetCounter();

        $this->assertEquals(0, $url->count);
    }
}
