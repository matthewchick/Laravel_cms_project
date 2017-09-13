<?php

/*
 *  1. configure database configuration inside .env
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
