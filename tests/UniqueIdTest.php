<?php

use SerbanBlebea\UrlShortener\Helpers\CreateShortUrlHelper as CreateUrl;
use SerbanBlebea\UrlShortener\Model\Link;
use SerbanBlebea\UrlShortener\Controllers\LinkController;

class UniqueIdTest extends TestCase
{
    public function test_change_unique_id_with_custom_one()
    {
        $url = new CreateUrl;
        $url->shortenUrl('google', 'http://www.google.com');

        $url = Link::where('name', 'google')->first();
        $url->changeUniqueId('serbanblebea');

        $short_url = $url->create_short_url();

        $this->assertTrue(starts_with($short_url, URL::to('/')));
        $this->assertTrue(str_contains($short_url, '/s/'));
        $this->assertTrue(ends_with($short_url, 'serbanblebea'));

        $this->assertEquals(URL::to('/') . '/s/serbanblebea', $short_url);
    }

    public function test_no_unique_id_when_selecting_custom_one()
    {
        $url_1 = new CreateUrl;
        $url_1->shortenUrl('google', 'http://www.google.com');

        $url_1 = Link::where('name', 'google')->first();
        $url_1->changeUniqueId('serbanblebea');

        $url_2 = new CreateUrl;
        $url_2->shortenUrl('facebook', 'http://www.facebook.com');

        $url_2 = Link::where('name', 'facebook')->first();
        $error = $url_2->changeUniqueId('serbanblebea');

        $this->assertEquals('The new unique id is already in use', $error);
    }
}