<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'vue_api'], function() {
    Route::get('/user_info', 'App\Http\Controllers\Api\UserInfoController@index')->name('vue.user_info');
    Route::resource('/users', 'App\Http\Controllers\Api\UserController', ['except' => ['edit', 'create']]);
    Route::resource('/roles', 'App\Http\Controllers\Api\RoleController', ['except' => ['edit', 'create']]);
});

?>