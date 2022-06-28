<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//{host}/api/article-comments/{id}
Route::get('article-comments/{id}', [App\Http\Controllers\Admin\Api\CommentController::class, 'getComment']);
//{host}/api/article-comments/{id}
Route::put('article-comments/{id}', [App\Http\Controllers\Admin\Api\CommentController::class, 'updateFullComment']);
//{host}/api/article-comments/{id}
Route::patch('article-comments/{id}', [App\Http\Controllers\Admin\Api\CommentController::class, 'updatePartComment']);
Route::delete('article-comments/{id}', [App\Http\Controllers\Admin\Api\CommentController::class, 'deletePartComment']);

//{host}/api/article-views
Route::put('article-views', [App\Http\Controllers\Api\ArticleController::class, 'views']);
//{host}/api/article-likes
Route::put('article-likes', [App\Http\Controllers\Api\ArticleController::class, 'likes']);

