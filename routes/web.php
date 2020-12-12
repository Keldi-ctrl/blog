<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', 'App\Http\Controllers\MainController@index');

Route::get('/blog', 'App\Http\Controllers\MainController@blog');

Route::get('/portfolio', 'App\Http\Controllers\MainController@portfolio');

Route::get('/contact', 'App\Http\Controllers\MainController@contact');
