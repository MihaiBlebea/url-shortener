<?php

Route::get('/s/{link}', [ 
    'uses' => '\SerbanBlebea\UrlShortener\Controllers\LinkController@index',
    'as' => 'link.index',
]);
