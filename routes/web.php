<?php

use App\Http\Controllers\DeniedController;
use App\Http\Controllers\HomeController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/admin', function () {
    return ("test");
})->middleware('admin')->name("admin");

Route::get('/denied', [DeniedController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/', [HomeController::class, 'index'])->name('dashboard');
