<?php

Route::group(['prefix' => 'api', 'middleware' => ['web'], 'namespace' => 'BrooksYang\ApiDoc\Controllers'], function () {

    // 文档主页
    Route::get('docs/{module?}', 'DocController@index');
});
