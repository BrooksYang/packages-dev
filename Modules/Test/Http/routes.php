<?php

Route::group(['middleware' => 'web', 'prefix' => 'test', 'namespace' => 'Modules\Test\Http\Controllers'], function()
{
    Route::resource('test', 'TestController');
});
