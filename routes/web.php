<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cabinet\CabinetController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminTagController;

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
	Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
});
//Administration zone
Route::prefix('admin')->group(function(){// Prefix for all route URIs
	Route::middleware(['is_admin'])->group(function(){
		Route::get('/',[AdminHomeController::class, 'index'])->name('admin.index');
		// The name method may be used to prefix each route name in the group with a given string
		Route::name('admin.')->group(function () {
			Route::resource('/articles', AdminArticleController::class);
			Route::get('/article/comments/{id}',[AdminArticleController::class, 'articleComments'])->name('article.comments');
			Route::delete('/article/comments/{id}',[AdminArticleController::class, 'articleCommentDelete'])->name('article.comments.delete');
			//http://laravelblogsecond/admin/articles/{artId}/edit?page=1
			Route::get('/article/{artId}/edit',[AdminArticleController::class, 'articleCommenstDraw'])->name('article.comments.draw');
			Route::resource('/tags', AdminTagController::class);
		});
	});
});
