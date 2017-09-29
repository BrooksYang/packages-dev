<?php

Route::group(['prefix' => 'api', 'middleware' => ['web'], 'namespace' => 'BrooksYang\ApiDoc\Controllers'], function () {

    // api主页
    Route::get('docs/{module?}', 'DocController@index');

    // api详情
    Route::get('{api}', 'DocController@show');
});
