<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'vue_api'], function() {
    Route::get('/user_info', 'App\Http\Controllers\Api\UserInfoController@index')->name('vue.user_info');
    // Route::get('/user_menu', 'App\Http\Controllers\Api\UserMenuController@index')->name('vue.user_menu');;
});

?>