<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Mdata;
use App\Http\Controllers\temp;

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

# Syntax :- Route::view("uri", "view_name", ['array_key'=>'array_data']);

Route::view("/","welcome");

// Route::view("aboutus","about");

Route::view("profile","admin.profile");

# Deal with data, must be in array type, use array key in your view to access data

// Route::view("aboutus","about", ['name' => 'sandeep']);


# Syntax :- Route::get("uri", function(){ return view('view_name',['array_key'=>'array_data']); });

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return 'Also send string';
// });

// Route::get('aboutus', function () {
//     return view('about', ['name' => 'sandeep', 'marks' => 85]);
// });

// Route::get('aboutus', function () {
//     return view('about')->with('name','sandeep');
// });

# Route Parameter, must alphabetic and close in {}
# Syntax :- Route::get("uri/{p_para}", function($para){ return $para });

// Route::get('aboutus/{u_name}', function ($name) {
//     return $name;
// });

// Route::get('post/{p_id}/comment/{c_id}', function ($post, $comment) {
//     return $post.$comment;
// });

# Optional Routes parameter, palce with ?
# Syntax :- Route::get("uri/{p_para?}", function($para = 'Default'){ return $para; });

// Route::get('name/{u_name?}', function ($name = 'sandeep') {
//     return $name;
// });

# Routes parameter with Regular Expression, with where method
# Syntax :- Route::get("uri/{p_para}", function($para){ return $para; })->where('p_para','Regular expression');

// Route::get('name/{u_name}', function ($name) {
//     return $name;
// })->where('u_name','[A-Za-z]+');

// Route::get('name/{u_id}/{u_name}', function ($id, $name) {
//     return $id.$name;
// })->where(['u_id'=>'[0-9]+', 'u_name'=>'[a-z]+']);

// Route::get('name/{u_id}/{u_name}', function ($id, $name) {
//     return $id.$name;
// })->whereNumber('u_id')->whereAlpha('u_name');

// Route::get('name/{u_id}/{u_name}', function ($id, $name) {
//     return $id.$name;
// })->whereUuid('u_id');

# Routes Redirect with redirect method, by default returns 302 status code
# Syntax :- Route::redirect('here'.'there', 301)
# Syntax :- Route::PermanentRedirect('here'.'there')
# Syntax :- Route::fallback(function(){ return "defualt msg / avoid 404 page"});

# Routes
# Syntax :- Route::get('uri', function(){});
# Syntax :- Route::post('uri', function(){});
# Syntax :- Route::put('uri', function(){});
# Syntax :- Route::patch('uri', function(){});
# Syntax :- Route::delete('uri', function(){});
# Syntax :- Route::options('uri', function(){});
# Syntax :- Route::match(['get', 'post'], 'uri', function(){});
# Syntax :- Route::any('uri', function(){});


# For model 
Route::get('show', [StudentController::class, 'show']);
Route::fallback(function(){ return "defualt msg / avoid 404 page";});

Route::get('aboutus/{u_name?}', function ($name = '') {
    return view('about', ['name'=> $name]);
});

Route::get('mdata/{u_name?}', [Mdata::class, 'show_mdata']);
