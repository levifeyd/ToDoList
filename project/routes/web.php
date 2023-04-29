<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('dashboard', [\App\Http\Controllers\ItemController::class, 'index'])->name('dashboard');
    Route::get('show-item/{id}', [\App\Http\Controllers\ItemController::class, 'show'])->name('show-item');
    Route::get('create-item', [\App\Http\Controllers\ItemController::class, 'create'])->name('create-item');
    Route::post('store-item', [\App\Http\Controllers\ItemController::class, 'store'])->name('store-item');
    Route::get('edit-item/{id}', [\App\Http\Controllers\ItemController::class, 'edit'])->name('edit-item');
    Route::put('update-item/{id}', [\App\Http\Controllers\ItemController::class, 'update'])->name('update-items');
});
require __DIR__.'/auth.php';
