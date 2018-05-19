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

Just like bit.ly, you can create a url shortening service in your Laravel app.

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

Then add the Service Provider and the Facade to the config/app.php file

### UrlShortenerServiceProvider
```php
'providers' => [
    SerbanBlebea\UrlShortener\UrlShortenerServiceProvider::class,
];
```

### ShortUrl Facade
```php
'aliases' => [
    'ShortUrl' => SerbanBlebea\UrlShortener\Facades\ShortUrl::class,
];
```

## Use URL-Shortener
URL-Shortener is very easy to use:

### Step 1. Create the table
Before using the package, use the command line `php artisan migrate` to migrate the database table `links`.

This will be used to store the data for the short urls and the visitor count for every link.

### Step 2. Publish the config file
Run `php artisan vendor:publish` and select the package name to publish the config file `url-shortener.php` in the `config` folder.

<strong>!IMPORTANT</strong> If you change the `special_route_param`, all your existing linksspread across the internet will be nulled, so I would setup this option before using the package in production

### Step 3. Create your first short url
After you migrated the table, it's time to create your first short url:
```php
<?php

namespace App\Http\Controllers;

use SerbanBlebea\UrlShortener\ShortUrl;

class TestController extends Controller
{
    public function index()
    {
        $url = ShortUrl::shortenUrl('name-of-the-url', 'http://url-that-you-want-to-shorten.com');
        $short_url = $url->getShortUrl()
        // return http://www.name-of-your-host.com/s/fs53rw7h
        // 's' => name of the 'special_route_param' in config file
    }
}
```
### Step 4. Change the unique id
Every short url has an unique id that is used for accessing the destination link.

Exemple: `http://your-domain.com/s/unique-id`

Usually the unique id is string composed from 8 characters, so you may want to personalize it.

You can do that with:

```php
<?php

namespace App\Http\Controllers;

use ShortUrl;

class TestController extends Controller
{
    public function index()
    {
        // old_id = 'eujfg849'
        // new_id = 'soda'

        // Use this method to change the unique id
        ShortUrl::changeUniqueId('eujfg849', 'soda');
    }
}
```

This will be your new short url: `http://your-domain.com/s/soda`

### Step 4. Count clicks of add Google UTM taggs

You can track clicks to your url directly from your app, or you can use Google Analytics.

Let's first look at how you can get the number of clicks from the database:

```php
<?php

namespace App\Http\Controllers;

use ShortUrl;

class TestController extends Controller
{
    public function index()
    {
        // Get the short url from database by url name
        ShortUrl::count('name-of-url');
    }
}
```

If you want something more advanced, let's add some tracking for Google Analytics.

Add tracking when you create the short url:
```php
<?php

namespace App\Http\Controllers;

use ShortUrl;

class TestController extends Controller
{
    public function index()
    {   
        $url = ShortUrl::shortenUrl('name-of-the-url', 'http://url-that-you-want-to-shorten.com', 'campaign-name', 'medium-name', 'source-name');
    }
}
```

Or add tracking after you created the short url:
```php
<?php

namespace App\Http\Controllers;

use ShortUrl;

class TestController extends Controller
{
    public function index()
    {   
        $url = ShortUrl::shortenUrl('name-of-the-url', 'http://url-that-you-want-to-shorten.com');
        $url->update([
            'campaign' => 'campaign-name',
            'medium' => 'medium-name',
            'source' => 'source-name'
        ]);
    }
}
```

### Step 5. Reset the tracking counter

There is a method to reset the tracking counter. Very easy to use.

```php
<?php

namespace App\Http\Controllers;

use ShortUrl;

class TestController extends Controller
{
    public function resetCount()
    {
        $count = ShortUrl::get('name-of-the-short-url')->resetCounter();
    }
}

```
### Step 6. Special Command
After you run `php artisan vendor:publish` (see above), you will also have access to a special command for creating short url from the CLI.

Just type `php artisan make:shorter <just-url-after-app-root> <name-of-the-url>`

For example: `php artisan make:shorter /test/page/1 FirstBlogPost`. This will create a short url with the name `FirstBlogPost`.

The name of the url can be nulled in the CLI, this will generate a random string that you can change later


## Testing
