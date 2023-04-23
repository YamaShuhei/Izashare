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
    //ユーザー画面
    Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    #投稿用
    Route::group(['prefix' => 'post'], function(){
    // 新規投稿
    Route::get('/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    // 一覧表示
    Route::get('/index', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    // 詳細画面
    Route::get('/show/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
    // 編集/アップデート/削除
    Route::get('/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::post('/update/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::post('/destroy/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');

    });
    // コメント関連(投稿・削除)
    Route::post('/posts/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}/destroy', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

    // ユーザーページ用
    Route::group(['prefix' => 'user'], function(){

    Route::get('/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::get('/show/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::post('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    });

})->middleware('auth');

    //管理者画面用
    ////管理者アカウント作成・ログイン・ログアウト
    Route::get('/login/admin', [App\Http\Controllers\admin\LoginController::class, 'showAdminLoginForm']);
    Route::get('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm']);
    Route::post('/login/admin', [App\Http\Controllers\admin\LoginController::class, 'adminLogin']);
    Route::post('/logout/admin', [App\Http\Controllers\admin\LoginController::class, 'adminLogout']);
    Route::post('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'registerAdmin'])->name('admin-register');

    Route::group(['prefix' => 'admin'], function(){
    ////投稿一覧・詳細・削除
    Route::get('/index', [App\Http\Controllers\admin\AdminPostController::class, 'index'])->middleware('auth:admin')->name('adminpost.index');
    Route::get('/show/{id}', [App\Http\Controllers\admin\AdminPostController::class, 'show'])->middleware('auth:admin')->name('adminpost.show');
    Route::post('/destroy/{id}', [App\Http\Controllers\admin\AdminPostController::class, 'destroy'])->middleware('auth:admin')->name('adminpost.destroy');
    ////コメント削除
    Route::delete('/comments/{comment}/destroy', [App\Http\Controllers\admin\AdminCommentController::class, 'destroy'])->middleware('auth:admin')->name('admincomments.destroy');
    //csvインポート・エクスポート
    Route::view('/csv', '/admin/csv')->middleware('auth:admin');
    Route::post('/csv/import', [App\Usecases\Csv\UploadUsecase::class, 'run'])->middleware('auth:admin')->name('csv.upload');
    Route::post('/csv/download', [App\Usecases\Csv\DownloadUsecase::class, 'run'])->middleware('auth:admin')->name('csv.download');
    });
    


