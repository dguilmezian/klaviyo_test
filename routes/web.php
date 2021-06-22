<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (!Auth::check())
        return view('auth.login');
    else
        return \Illuminate\Support\Facades\Redirect::route('members.list');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/token',[\App\Http\Controllers\Klaviyo\KlaviyoController::class,'show'])->name('klaviyo.show');
Route::post('/token',[\App\Http\Controllers\Klaviyo\KlaviyoController::class,'storeToken'])->name('klaviyo.save');

Route::get('/list',[\App\Http\Controllers\Klaviyo\KlaviyoController::class,'showListId'])->name('klaviyo.show_contacts_list_id');
Route::post('/list',[\App\Http\Controllers\Klaviyo\KlaviyoController::class,'storeContactsListId'])->name('klaviyo.save_contacts_list_id');
Route::get('/members',[\App\Http\Controllers\Member\MemberController::class,'index'])->name('members.list');
