<?php

/*  Finish Section 1 - 9, 11, 12, 22, 26, 27*, 39*
 *  1. configure database configuration inside .env  Section 1, 2 and 3
 *  2. php artisan migrate - create two tables - users and password
 *  3. php artisan make:auth - scaffold basic login and registration views and routes - install HomeController and a bundle views files under resources
 *     https://laravel.com/docs/5.2/routing - Section 4 (Route)  => route.php inside HTTP
 *     https://laravel.com/docs/5.2/authentication - Section 22 (Form Login)
 *     The file(s) that you're looking for are located in: App\Http\Middleware  folder.
 *     Name of the files: Authenticate.php  & RedirectIfAuthenticated.php
 *  4. Users table Migration  - create php class and make a table - php artisan migrate => Section 8 (Laravel Migration)
 *     add role_id and isactive inside schema: user
 *     php artisan make:model Role -m Create a new Eloquent model class, -m mean migration
 *     php artisan make:migration create_post_table --create="posts" => create a migration file
	   php artisan migrate:rollback
       add column to existing table => php artisan make:migration add_is_admin_col_to_posts_table --table=posts
	5. php artisan make:seeder UsersTableSeeder => dumpy data User table (Section 39)
    6. relation setup and data entry => belongsTo  (Section 9 and 11)
    7. use Tinker to check the relation => php artisan tinker => $user = App\User::find(1);  (Section 12)
    8. Create AdminUsersController => php artisan make:controller --resource AdminUsersController  (Section 5) Controller => resources means to
       add all methods including store, index, destroy, edit, update and so on
	   Route::get('/admin', 'AdminUsersController@index');   inside the route.php
       Route::get('/admin/{id}', 'AdminUsersController@index');     => change index($id) inside the AdminUsersController
    9. php artisan route:list - list all routes
   10. install node.js and gulp by using npm i -g gulp  for laravel 5.2 but not for laravel 5.4 above
	   php artisan --version
       npm install laravel-elixir --save-dev
   11. npm install
       move font folder into the public
       move js and css folder into the resources/assets
       use the command, gulp with laravel elixir to compact css and js files
   12. Add admin.blade.php as a layout  Section 6 and 7 Views and Blade templating engine
       https://laravel.com/docs/5.2/views   => In Symfony, use Twig,  => Laravel, use blade
       pass data to view, use {{$id}} in html <= return view('post'->with('id',$id); or return view('post', compact(id)); Section 6 View
       https://laravel.com/docs/5.2/blade
	   @extends()
       @yield()
       @if..@endif, @while..@endwhile, @for..@endfor, @foreach..@endforeach
       @include()
   13. Display User - use diffForHuman()

    final: APP_ENV=local => production
		   APP_DEBUG=true => false
	https://devcenter.heroku.com/articles/getting-started-with-laravel
*/
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
