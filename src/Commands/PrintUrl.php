<?php

namespace SerbanBlebea\UrlShortener\Commands;

use Illuminate\Console\Command;
use SerbanBlebea\UrlShortener\ShortUrl;
use SerbanBlebea\UrlShortener\Model\Link;

class PrintUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:print {--name=} {--dest=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Print short url from the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $schema = Link::query();

        if($this->option('name') !== null)
        {
            $schema->where('name', $this->option('name'));
        }

        if($this->option('dest') !== null)
        {
            $schema->where('destination', $this->option('dest'));
        }

        $links = $schema->get();
        foreach($links as $link)
        {
            $this->info('NAME: ' . $link->name . ' | DESTINATION: ' . $link->destination_link . ' | SHORT: ' . $link->getShortUrl());
        }
    }
}
