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
Route::get('/',         ['as'=>'blog.index',    'uses' => 'Pages\HomeController@index']);
Route::get('/about',    ['as'=>'blog.about',    'uses' => 'Pages\AboutController@index']);
Route::get('/contact',  ['as'=>'blog.contact',  'uses' => 'Pages\ContactController@index']);

/*
 * Routes for administrative panel of blog
 */
Route::group(['prefix' => 'panel'], function(){
    Route::get('',                      ['as' => 'panel.dashboard.index',   'uses' => 'Panel\DashboardController@index']);

    Route::group(['prefix' => 'posts'], function(){
        Route::get('',                  ['as' => 'panel.posts.index',       'uses' => 'Panel\PostsController@index']);
        Route::get('create',            ['as' => 'panel.posts.create',      'uses' => 'Panel\PostsController@create']);
        Route::post('store',            ['as' => 'panel.posts.store',       'uses' => 'Panel\PostsController@store']);
        Route::get('{id}/edit',         ['as' => 'panel.posts.edit',        'uses' => 'Panel\PostsController@edit']);
        Route::put('{id}/update',       ['as' => 'panel.posts.update',      'uses' => 'Panel\PostsController@update']);
        Route::delete('{id}/destroy',   ['as' => 'panel.posts.destroy',     'uses' => 'Panel\PostsController@destroy']);
        Route::get('{id}/comments',     ['as' => 'panel.posts.comments',    'uses' => 'Panel\PostsController@comments']);
    });

    Route::group(['prefix' => 'comments'], function(){
        Route::get('',                      ['as' => 'panel.comments.index',            'uses' => 'Panel\CommentsController@index']);
        Route::put('{id}/toggleConfirm',    ['as' => 'panel.comments.toggleConfirm',    'uses' => 'Panel\CommentsController@toggleConfirm']);
        Route::delete('destroy/{id}',       ['as' => 'panel.comments.destroy',          'uses' => 'Panel\CommentsController@destroy']);
    });

});