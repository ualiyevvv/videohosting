<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;

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

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/{nickname}/videos', [MainController::class, 'myVideos'])->name('user.videos');

Route::get('/video/{id}/show', [VideoController::class , 'show'])->name('video.show');



Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware' => 'admin'], function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categoriesAdd');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categoriesEdit');
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('admin.categoriesUpdate');
    Route::get('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.categoriesDelete');
    //Route::get('/video', 'MainController@video')->name('videoAdmin');

});

Route::group(['prefix'=>'admin', 'middleware' => 'admin'], function(){
    Route::get('/video/{id}/edit', [VideoController::class, 'adminEdit'])->name('admin.video.edit');
});


Route::group(['middleware' => 'guest'], function(){
    Route::get('/register', [AuthController::class, 'create'])->name('user.create');
    Route::post('/register/store', [AuthController::class, 'store'])->name('user.store');
    
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login/store', [AuthController::class, 'login'])->name('login.store');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/user/request-confirmation', [UserController::class, 'requestConfirmEmail'])->name('request-confirm-email');
    Route::get('/user/send-request-confirmation', [UserController::class, 'sendConfirm'])->name('send-confirmation-email');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/user/confirm-email/{token}', [UserController::class, 'confirmEmail'])->name('confirm-email');



Route::group(['middleware' => ['auth', 'confirmed'] ], function(){
    Route::post('/setting/change-password/{id}', [UserController::class, 'changePass'])->name('user.change.password');
    Route::get('/setting', [UserController::class, 'setting'])->name('user.setting');
    Route::get('/setting/session-delete/{id}', [UserController::class, 'sessionDelete'])->name('session.delete');
    
    Route::get('/video', [VideoController::class, 'index'])->name('video.list');
    Route::get('/video/new', [VideoController::class, 'create'])->name('video.new');
    Route::post('/video/new', [VideoController::class, 'store'])->name('video.store');
    Route::get('/video/{id}/edit', [VideoController::class, 'edit'])->name('video.edit');
    Route::post('/video/{id}/update', [VideoController::class, 'update'])->name('video.update');
    Route::get('/video/{id}/delete', [VideoController::class, 'destroy'])->name('video.delete');
    Route::get('/video/{id}/like', [VideoController::class, 'like'])->name('video.like');
    Route::get('/video/{id}/dislike', [VideoController::class, 'dislike'])->name('video.dislike');
    
    //Route::get('/video/{id}/comments', 'CommentController@index')->name('comment.list');
    Route::post('/video/{id}/comment/store', [CommentController::class, 'store'])->name('comment.store');
});