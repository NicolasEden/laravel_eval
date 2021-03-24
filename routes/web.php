<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeniedController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'index'])->name("admin");
    Route::get('/add', [AdminController::class, 'indexAdd'])->name("adminAdd");
    Route::post('/add', [AdminController::class, 'store'])->name("APIadminAdd");
});
Route::get('/denied', [DeniedController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/', [HomeController::class, 'index'])->name('dashboard');
