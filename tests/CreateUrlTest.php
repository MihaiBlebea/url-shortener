<?php

use SerbanBlebea\UrlShortener\ShortUrl;
use SerbanBlebea\UrlShortener\Model\Link;
use Illuminate\Support\Facades\URL;

class CreateUrlTest extends TestCase
{
    private $test_url_dest = '/test/home/1';

    private $test_url_name = 'home';

    public function test_create_short_url()
    {
        $url = ShortUrl::shortenUrl($this->test_url_name, $this->test_url_dest);
        $this->assertEquals($this->test_url_name, $url->name);
        $this->assertEquals($this->test_url_dest, $url->destination_link);
    }

    // public function test_generate_unique_id()
    // {
    //     $url_1 = new CreateUrl;
    //     $url_1->shortenUrl('google', 'http://www.google.com');
    //
    //     $url_2 = new CreateUrl;
    //     $url_2->shortenUrl('facebook', 'http://www.facebook.com');
    //
    //     $url_1 = Link::where('name', 'google')->first();
    //     $url_2 = Link::where('name', 'facebook')->first();
    //
    //     $this->assertFalse($url_1->unique_id == $url_2->unique_id);
    // }
    //
    // public function test_required_valid_url()
    // {
    //     $url = new CreateUrl;
    //     $error = $url->shortenUrl('google', 'google.com');
    //
    //     $url = Link::where('name', 'google')->first();
    //
    //     $this->assertTrue($url == null);
    //     $this->assertEquals('Your destination link is not a valid url', $error);
    // }
    //
    // public function test_required_unique_name()
    // {
    //     $url_1 = new CreateUrl;
    //     $url_1->shortenUrl('google', 'http://www.google.com');
    //
    //     $url_2 = new CreateUrl;
    //     $error = $url_2->shortenUrl('google', 'http://www.facebook.com');
    //
    //     $url = Link::where('destination_link', 'http://www.facebook.com')->first();
    //
    //     $this->assertTrue($url == null);
    //     $this->assertEquals('The selected name for the short url is not unique', $error);
    // }
    //
    // public function test_get_destination_link_with_params()
    // {
    //     $url = new CreateUrl;
    //     $url->shortenUrl('google', 'http://www.google.com', 'direct-trafic', 'google', 'banner');
    //
    //     $url = Link::where('name', 'google')->first();
    //     $url->getShortUrl();
    //
    //     $this->assertEquals('http://www.google.com?campaign=direct-trafic&medium=banner&source=google', $url->getShortUrl());
    // }
    //
    // public function test_generated_short_link()
    // {
    //     $url = new CreateUrl;
    //     $result_url = $url->shortenUrl('google', 'http://www.google.com');
    //
    //     $this->assertTrue(starts_with($result_url, URL::to('/')));
    //     $this->assertTrue(str_contains($result_url, '/s/'));
    // }
}
