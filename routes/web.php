<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cabinet\CabinetController;
use App\Http\Controllers\ArticleController;

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

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/articles/tag/{tag}', [ArticleController::class, 'allByTag'])->name('article.tag');
//Middleware RedirectIfAuthenticated was changed.If you are 'guest' you will be redirected to home() route.
//We cannot follow these routes if we are authenticated
Route::middleware(['guest'])->group(function(){
	//Sign up
	Route::get('/signup',[AuthController::class, 'signupForm'])->name('signup');
	Route::post('/signup',[AuthController::class, 'signupStore']);
	//Sign in
	Route::get('/signin',[AuthController::class, 'signinForm'])->name('signin');
	Route::post('/signin',[AuthController::class, 'signinStore']);
});
//Middleware 'auth' only for authenticated users
Route::post('/signout',[AuthController::class, 'signOut'])->name('signout')->middleware('auth');

Route::middleware(['auth'])->group(function(){
	//Cabinet
	Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet');
});
