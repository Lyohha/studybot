<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index.index');
// });

// Route::get('/suer', function () {
//     return view('index.index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

require __DIR__.'/vue.php';

Route::get('/{any_path?}', 'App\Http\Controllers\IndexController@index')->where('any_path', '(.*)')->name('app.main');
Route::get('/users', 'App\Http\Controllers\IndexController@index404')->name('app.users.list');
Route::get('/users/add', 'App\Http\Controllers\IndexController@index404')->name('app.users.add');
Route::get('/users/{id}', 'App\Http\Controllers\IndexController@index404')->name('app.users.edit');