<?php

Route::group(['prefix' => 'api', 'middleware' => ['web'], 'namespace' => 'BrooksYang\ApiDoc\Controllers'], function () {

    Route::get('docs', 'DocController@index');
});
