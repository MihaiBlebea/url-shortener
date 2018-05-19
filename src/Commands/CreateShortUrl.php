<?php

namespace SerbanBlebea\UrlShortener\Commands;

use Illuminate\Console\Command;
use SerbanBlebea\UrlShortener\ShortUrl;

class CreateShortUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:make {url} {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate short url from a specific link';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if($this->argument('name') == null)
        {
            $name = str_random(8);
        } else {
            $name = $this->argument('name');
        }

        if($this->confirm('Are you sure you want to create a short url for ' . $this->argument('url') . '?'))
        {
            $short_url = ShortUrl::shortenUrl($name, $this->argument('url'));
            if(is_string($short_url))
            {
                return $this->info($short_url);
            }
            return $this->info('Your short url: ' . $short_url->getShortUrl());
        }
    }
}
