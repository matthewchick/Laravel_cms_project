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

Route::get('/admin', function () {
	return view('admin.index');   //admin means admin folder
});
// create a special route by using resource - php artisan list:route - list all resources routes
// https://laravel.com/docs/5.2/controllers

Route::group (['middleware'=>'admin'], function () {
	Route::resource('admin/users', 'AdminUsersController');
});



/*
 * This route group applies the "web" middleware group to
 * every route it contains. The web middleware group is defined
 * in your HTTP kernel and includes session state, CSRF protection
 * Route::group(['middleware' => ['web']], function () {  });
 */


/* Perform CRUD operation - Section 9  RawSQL Queries
// https://laravel.com/docs/5.2/database
Route::get('insert', function() {
	DB::insert('insert into roles(name) values(?)', ['Guest']);
});

Route::get('update', function() {
	DB::update('update roles set name = 'Guest' where name = ?', ['Peter']);
});

Route::get('delete', function() {
	DB::delete('delete from roles where name = ?', ['Peter']);
});

Route::get('select', function() {
	$roles =DB::select('select * from roles where name = ?', ['Peter']);
    return view ('Roles ". [$roles]);
});
*/