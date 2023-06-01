<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\PagesController;

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



// Guest
Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [PagesController::class, 'home']);
});
