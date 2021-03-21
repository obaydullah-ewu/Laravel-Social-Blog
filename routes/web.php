<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfilesController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/hello', function () {
//     // return view('welcome');
//     return '<h1>Hello World</h1>';
// });


// Route::get('/users/{id}/{name}', function($id, $name){
//     return 'This is user ' .$name. ' with an id of ' .$id;
// });

Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);
// Route::get('/services', [PagesController::class, 'services']);
Route::get('/timeline/{id}', [PagesController::class, 'timeline'])->name('timeline');


Route::get('/posts/search', [PostController::class, 'search'])->name('search');
Route::get('/posts/like', [PostController::class, 'like'])->name('like');

Route::resource('posts', PostController::class);
Route::resource('comments', CommentsController::class);
// Route::resource('userprofiles', UserProfilesController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/edit/user', [UserController::class, 'edit'])->name('user.edit');
Route::post('/edit/user', [UserController::class, 'update'])->name('user.update');

Route::get('/edit/password/user', [UserController::class, 'passwordEdit'])->name('password.edit');
Route::post('/edit/password/user', [UserController::class, 'passwordUpdate'])->name('password.update');
Route::get('/user/searchpeople', [UserController::class, 'searchpeople'])->name('searchpeople');

