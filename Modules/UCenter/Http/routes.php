<?php

Route::group(['middleware' => 'web', 'prefix' => 'ucenter', 'namespace' => 'Modules\UCenter\Http\Controllers'], function()
{
    Route::get('/', 'UCenterController@index');
});
