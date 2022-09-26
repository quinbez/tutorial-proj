<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin', function() {
    return view('layouts.admin');
});


Route::group(['prefix'=>'admin'], function() {

    Route::resource('/users','App\Http\Controllers\AdminUsersController', ['as' => 'admin']);
   
    Route::resource('/posts','App\Http\Controllers\AdminPostsController', ['as' => 'admin']);

    Route::resource('/categories','App\Http\Controllers\AdminCategoriesController', ['as' => 'admin']);

    Route::resource('/media', 'App\Http\Controllers\AdminMediasController', ['as'=>'admin']);

});
    