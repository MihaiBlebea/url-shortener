<?php

Route::get('/short/{link}', [ 
    'uses' => '\SerbanBlebea\UrlShortener\Controllers\LinkController@index',
    'as' => 'link.index',
]);
