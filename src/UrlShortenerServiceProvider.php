<?php

namespace SerbanBlebea\UrlShortener;

use Illuminate\Support\ServiceProvider;
use SerbanBlebea\UrlShortener\Commands\{
    CreateShortUrl,
    PrintUrl,
    CreateFromRoute
};
use SerbanBlebea\UrlShortener\ShortUrl;

class UrlShortenerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        $this->publishes([
            __DIR__ . '/../configs/url-shortener.php' => config_path('url-shortener.php')
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateShortUrl::class,
                PrintUrl::class,
            ]);
        }
    }

    public function register()
    {
        $this->app->bind('ShortUrl', function() {
            return new ShortUrl();
        });
    }
}
