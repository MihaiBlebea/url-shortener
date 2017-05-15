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
        $url->shortenUrl('name-of-the-url', 'http://url-that-you-want-to-shorten.com');
        
    }
}
```
### Step 3. Change the unique id
Every short url has an unique id that is used for accessing the destination link.

Exemple: `http://your-domain.com/s/unique-id`

Usually the unique id is string composed from 8 characters, so you may want to personalize it.

You can do that with:

```php
<?php

namespace App\Http\Controllers;

use SerbanBlebea\UrlShortener\Model\Link;

class TestController extends Controller
{
    public function index()
    {
        // Get the specific url from database ($link)
        $link = Link::where('name', 'name-of-the-url')->first();
        
        // Use this method to change the unique id
        $link->changeUniqueId('new-id-of-the-url');
    }
}
```

This will be your new short url: `http://your-domain.com/s/new-id-of-the-url`

### Step 4. Count clicks of add Google UTM taggs

You can track clicks to your url directly from your app, or you can use Google Analytics.

Let's first look at how you can get the number of clicks from the database:

```php
<?php

namespace App\Http\Controllers;

use SerbanBlebea\UrlShortener\Model\Link;

class TestController extends Controller
{
    public function index()
    {
        // Get the short url from database by url name
        $link = Link::where('name', 'name-of-the-url')->first();
        
        // Get the short url from database by destination link
        $link = Link::where('destination_link', 'http://www.the-destination-link.com')->first();
        
        // Get number of clicks
        $count = $link->count;
    }
}
```

If you want something more advanced, let's add some tracking for Google Analytics.

Add tracking when you create the short url:
```php
<?php

namespace App\Http\Controllers;

use SerbanBlebea\UrlShortener\Helpers\CreateShortUrlHelper as CreateUrl;

class TestController extends Controller
{
    public function index()
    {   
        $url = new CreateUrl;
        $url->shortenUrl('name-of-the-url', 'http://url-that-you-want-to-shorten.com', 'campaign-name', 'medium-name', 'source-name');
    }
}
```

Or add tracking after you created the short url:
```php
<?php

namespace App\Http\Controllers;

use SerbanBlebea\UrlShortener\Model\Link;
use SerbanBlebea\UrlShortener\Helpers\CreateShortUrlHelper as CreateUrl;

class TestController extends Controller
{
    public function index()
    {   
        $url = new CreateUrl;
        $url->shortenUrl('name-of-the-url', 'http://url-that-you-want-to-shorten.com');
        
        $link = Link::where('name', 'name-of-the-url')->first();
        $link->update([
            'campaign' => 'campaign-name',
            'medium' => 'medium-name',
            'source' => 'source-name'
        ]);
    }
}
```

## Testing
