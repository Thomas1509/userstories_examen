<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/klanten', [App\Http\Controllers\KlantController::class, 'index'])->name('klant.index');

Route::get('/klanten/{id}', [App\Http\Controllers\KlantController::class, 'show'])->name('klant.show');

Route::get('/klanten/{id}/edit', [App\Http\Controllers\KlantController::class, 'edit'])->name('klant.edit');

Route::put('/klanten/{id}', [App\Http\Controllers\KlantController::class, 'update'])->name('klant.update');

