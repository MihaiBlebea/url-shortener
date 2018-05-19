<?php

use SerbanBlebea\UrlShortener\ShortUrl;

class UniqueIdTest extends TestCase
{
    private $test_url_dest = '/test/home/1';

    private $test_url_name = 'home';

    public function test_change_unique_id_with_custom_one()
    {
        $url = ShortUrl::shortenUrl($this->test_url_name, $this->test_url_dest);
        $url->count = 1000;
        
        $new_url = ShortUrl::changeUniqueId($url->unique_id, 'sudoku');

        $this->assertEquals($new_url->unique_id, 'sudoku');
        $this->assertEquals($new_url->count, 0);
    }
    //
    // public function test_no_unique_id_when_selecting_custom_one()
    // {
    //     $url_1 = new CreateUrl;
    //     $url_1->shortenUrl('google', 'http://www.google.com');
    //
    //     $url_1 = Link::where('name', 'google')->first();
    //     $url_1->changeUniqueId('serbanblebea');
    //
    //     $url_2 = new CreateUrl;
    //     $url_2->shortenUrl('facebook', 'http://www.facebook.com');
    //
    //     $url_2 = Link::where('name', 'facebook')->first();
    //     $error = $url_2->changeUniqueId('serbanblebea');
    //
    //     $this->assertEquals('The new unique id is already in use', $error);
    // }
}
