<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeniedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanierController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'index'])->name("admin");
    Route::get('/add', [AdminController::class, 'indexAdd'])->name("adminAdd");
    Route::get('/show', [AdminController::class, 'indexShow'])->name("adminShow");
    Route::get('/edit', [AdminController::class, 'indexEdit'])->name("adminEdit");
    Route::get('/delete', [AdminController::class, 'delete'])->name("APIadminDelete");
    Route::post('/add', [AdminController::class, 'store'])->name("APIadminAdd");
    Route::post('/edit', [AdminController::class, 'update'])->name("APIadminEdit");
});
Route::get('/denied', [DeniedController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/', [HomeController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified'], "prefix" => "panier"], function() {
    Route::get('/', [PanierController::class, 'index'])->name('panier');
    Route::get('/add', [PanierController::class, 'store'])->name('panier');
    Route::get('/delete', [PanierController::class, 'delete'])->name('panier');
});
