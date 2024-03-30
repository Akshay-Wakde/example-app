<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\VideosUrlController;

//FRONTEND ROUTES STARTS
Route::get('/', [MainController::class, 'index'])->name('/main');

//FRONTEND ROUTES ENDS
//ADMIN ROUTES STARTS
Route::get('/admin', [LoginController::class, 'login'])->name('admin');

Route::post('/login_action', [LoginController::class, 'loginAction'])->name('/login_action');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [LoginController::class, 'signup'])->name('signup');
Route::post('/signup_action', [LoginController::class, 'signupAction'])->name('signup_action');


Route::group(['middleware'=>['check_login']], function() {
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('home');
//BANNNER ROUTES STARTS
Route::get('banner.list', [BannerController::class, 'index'])->name('banner.list');
Route::get('banner.ajax', [BannerController::class, 'ajax_list'])->name('banner.ajax');
Route::get('banner.edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
Route::post('banner.update_action', [BannerController::class, 'update_action'])->name('banner.update_action');
Route::get('banner.add', [BannerController::class, 'add'])->name('banner.add');
Route::post('banner.add_action', [BannerController::class, 'add_action'])->name('banner.add_action');
Route::post('banner.ChangeIsOnline', [BannerController::class, 'ChangeIsOnline'])->name('banner.ChangeIsOnline');
Route::post('banner.DeleteBanner', [BannerController::class, 'DeleteBanner'])->name('banner.DeleteBanner');
//BANNNER ROUTES ENDS
//VIDOES URLS ROUTES STARTS
Route::get('url.list', [VideosUrlController::class, 'index'])->name('url.list');
Route::get('url.ajax', [VideosUrlController::class, 'ajax_list'])->name('url.ajax');

Route::get('url.add', [VideosUrlController::class, 'add'])->name('url.add');
Route::post('url.add_action', [VideosUrlController::class, 'add_action'])->name('url.add_action');

Route::post('url.ChangeIsOnline', [VideosUrlController::class, 'ChangeIsOnline'])->name('url.ChangeIsOnline');
Route::post('url.DeleteBanner', [VideosUrlController::class, 'DeleteUrl'])->name('url.DeleteUrl');

Route::get('url.edit/{id}', [VideosUrlController::class, 'edit'])->name('url.edit');
Route::post('url.update_action', [VideosUrlController::class, 'update_action'])->name('url.update_action');

//VIDOES URLS ROUTES ENDS



});
//ADMIN ROUTES ENDS