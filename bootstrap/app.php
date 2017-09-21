<?php

/*  Finish Section 1 - 9, 11, 12, 18 - 24, 26, 27*, 39*
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
   14. Create page  - Section 18 HTML Form and validation - New -> edit template -> to generate blade template
       create() -> store(Request $request) -> eloquent create() or save() -> save to DB inside the controller
       use index() -> read data
       use show($parameter) -> read data based on $parameter
       use edit() and update()
       use destroy()
   15. Use and install laravel collective html => https://laravelcollective.com/docs/5.2/html  (Section 19) Package and validation
	   composer require laravelcollective/html 5.2 => composer update
	   Add Collective\Html\HtmlServiceProvider::class, inside config/app.php
       Add 'Form' => Collective\Html\FormFacade::class,
           'Html' => Collective\Html\HtmlFacade::class,
       Blade {{ }} statements are automatically sent through PHP's htmlentities function to prevent XSS attacks.
	   If you don't want the data to be escaped then use {!! !!} else use {{ }}
   16. Modify Status to set to Not Active by default
   17. Populate the user role
   18. Create UserRequest.php as a middleware by php artisan make:request UserRequest
   19. Create an error message if not validated
   20. Upload the file ->  (Section 21) => https://laravel.com/docs/5.2/requests#files
	   {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store','files'=>true ]) !!}
       Add phpto_ID to users table => php artisan make:migration add_photo_id_to_users --table=users
	   php artisan migrate
       photo image - mass assignment => php artisan make:model Photo -m
   21. Create link by using {{route('admin.users')}}
   22. Display the image using accessor  (Section 20) Accessors and mutators
	   https://laravel.com/docs/5.2/eloquent-mutators
   23. Edit the user page
	   {!! Form::model($user, ['method'=>'PATCH', 'action'=>'AdminUsersController@update','files'=>true ]) !!}
   24. Update the user page => php artisan make:request UsersEditRequest
   25. use middleware for security    (section 23 ) middleware
	   php artisan make:middleware Admin
	   register 'admin' => \App\Http\Middleware\Admin::class, inside Http/Kernel.php
       add Route::group (['middleware'=>'admin'], function (){} inside Http/routes.php
   26. Delete the user and use session flash   Section 24 Session
	   Delete the image from directory
	   unlink(public_path() . $user->photo->file);
   27. Add more security

    final: APP_ENV=local => production
		   APP_DEBUG=true => false
	https://devcenter.heroku.com/articles/getting-started-with-laravel
    https://medium.com/@markustripp/getting-started-with-laravel-5-4-and-mongodb-1ad2892e473f
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
