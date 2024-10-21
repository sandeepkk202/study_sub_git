<?php

/*
How do you make and use Middleware in Laravel?

It acts as a middleman between a request and a response. Middleware is a type of
filtering mechanism used in Laravel application.
✓ We can create middelware with php artisan make: middleware UsersMiddleware

✓ Here "Usersmiddleware" is the name of Middleware. After this command a
"UsersMiddleware.php" file created in app/Http/Middleware directory.

✓ After that we have to register that middleware in kernel.php (available in app/Http
directory) file in "$routeMiddleware" variable.
'Users' => \App\Http\Middleware\UsersMiddleware::class,

✓ Now we can call "Users" middleware where we need it like controller or route file.

✓ We can use it in controller file like this.
public function __construct() {
$this->middleware('Users');
}

✓ In route file we can use like this.
Route::group(['middleware' => 'Users'], function () {
Route::get('/', 'HomeController@index');
});

*/