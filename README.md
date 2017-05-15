# URL-Shortener

<p align="center">
<img src="https://raw.githubusercontent.com/SerbanBlebea/url-shortener/master/img/url-shortener-logo.png">
</p>

## Menu

- About
- Install
- Use
- Testing

## About URL-Shortener
URL-Shortener is a package for creating short url links that track conversions for Laravel apps or websites.

Just like bit.ly, you can create your own url shortening service in your Laravel app.

Easy to install and easy to use.

Just read this file and let me know if I can help.

## Install URL-Shortener
Add this to the `composer.json` file:
```json
{
    "require": {
        "serbanblebea/urlshortener": "1.0"
    }
}
```

Or just use the command line:

    composer require serbanblebea/urlshortener
    
## Use URL-Shortener
URL-Shortener is very easy to use:

### Step 1. Create the table
Before using the package, use the command line `php artisan migrate` to migrate the database table `links`.

This will be used to store the data for the short urls and the visitor count for every link.

### Step 2. Create your first short url
After you migrated the table, it's time to create your first short url:
```php
<?php

namespace App\Http\Controllers;

use SerbanBlebea\UrlShortener\Helpers\CreateShortUrlHelper as CreateUrl;

class TestController extends Controller
{
    public function index()
    {
        $url = new CreateUrl;
        $url->shortenUrl('name-of-the-link', 'http://url-that-you-want-to-shorten.com');
        
    }
}
```


## Testing
