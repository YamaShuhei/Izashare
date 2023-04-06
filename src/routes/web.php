<?php

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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ログインしていない場合はトップページに遷移
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    #投稿用
    Route::group(['prefix' => 'post'], function(){
    Route::get('/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/index', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('/show/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
    Route::get('/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::post('/update/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::post('/destroy/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');

    });
    // コメント関連
    Route::post('/posts/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}/destroy', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

})->middleware('auth');


