<?php

use SerbanBlebea\UrlShortener\ShortUrl;

class TraficCountTest extends TestCase
{
    private $test_url_dest = '/test/home/1';

    private $test_url_name = 'home';

    public function test_new_url_has_traffic_zero()
    {
        $url = ShortUrl::shortenUrl($this->test_url_name, $this->test_url_dest);
        $this->assertEquals(0, $url->count);
    }
    //
    // public function test_reset_traffic_count()
    // {
    //     $url = new CreateUrl;
    //     $url->shortenUrl('home', 'http://www.fengshuiarmonie.ro');
    //
    //     $url = Link::where('name', 'home')->first();
    //
    //     $url->update([
    //         'count' => 25
    //     ]);
    //
    //     $this->assertEquals(25, $url->count);
    //
    //     $url->resetCounter();
    //
    //     $this->assertEquals(0, $url->count);
    // }
}
