<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FyearController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionController;

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
Route::view('/fyear', 'layouts.fyear');
// Auth::routes();

//Session
Route::get('get-session', [SessionController::class, 'getSession']);
Route::get('store-session', [SessionController::class, 'storeSession']);
Route::get('delete-session', [SessionController::class, 'deleteSession']);