<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Routes for pages of blog
 */
Route::get('/',         'Pages\HomeController@index');
Route::get('/about',    'Pages\AboutController@index');
Route::get('/contact',  'Pages\ContactController@index');

/*
 * Routes for administrative panel of blog
 */
