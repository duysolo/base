<?php

use Illuminate\Support\Facades\Route;

Route::get('/search', [
    'as' => 'front.search.get',
    'uses' => 'Pages\SearchController@index',
]);
