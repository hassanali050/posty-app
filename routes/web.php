<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\Auth\Login_Controller;
use App\Http\Controllers\Auth\Logout_Controller;
use App\Http\Controllers\Auth\Register_Controller;
use App\Http\Controllers\Post_Controller;
use App\Http\Controllers\Post_Like_Controller;
use App\Http\Controllers\User_Post_Controller;

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
Route::get('/', function() {
    return view('home');
})->name('home');
Route::get('/register', [Register_Controller::class, 'index'])->name('register');
Route::post('/register', [Register_Controller::class, 'store']);
Route::get('/dashboard', [Dashboard_Controller::class, 'index'])
->name('dashboard');
//->middleware('auth')

Route::get('/user/{user:username}/posts', [User_Post_Controller::class, 'index'])->name('users.posts');

Route::get('/login', [Login_Controller::class, 'index'])->name('login');
Route::post('/login', [Login_Controller::class, 'store']);
Route::post('/logout', [Logout_Controller::class, 'store'])->name('logout');

Route::get('/posts', [Post_Controller::class, 'index'])->name('posts');
Route::post('/posts',[Post_Controller::class, 'store']);
Route::get('/posts/{post}',[Post_Controller::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}',[Post_Controller::class, 'destroy'])->name('posts.destroy');

Route::post('posts/{post}/likes', [Post_Like_Controller::class, 'store'])->name('posts.likes');
Route::delete('posts/{post}/likes', [Post_Like_Controller::class, 'destroy'])->name('posts.likes');