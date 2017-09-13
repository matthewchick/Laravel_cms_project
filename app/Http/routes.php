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

Route::get('/', function () {
    return view('welcome');   // go to welcome.blade.php
});

/*
 * Route::get('/post/{id}/{$name}, function ($id, $name) {
 *   return "This is post number " . $id;
 * }
 *
 * Route::get('admin/posts/example, array('as'=>'admin.home', function() {  //named route
 *    $url = route('admin.home');
 *    return "this url is " . $url;
 * }));
 */

// php artisan make:auth to create the following routes
Route::auth();

Route::get('/home', 'HomeController@index');


/*
 * This route group applies the "web" middleware group to
 * every route it contains. The web middleware group is defined
 * in your HTTP kernel and includes session state, CSRF protection
 * Route::group(['middleware' => ['web']], function () {  });
 */