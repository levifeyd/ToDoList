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
    Route::get('dashboard', [\App\Http\Controllers\ToDoListController::class, 'index'])->name('dashboard');

    Route::get('create-tag{id}', [\App\Http\Controllers\ItemController::class, 'createTag'])->name('create-tag');

    Route::get('create-list', [\App\Http\Controllers\ToDoListController::class, 'create'])->name('create-list');
    Route::post('store-list', [\App\Http\Controllers\ToDoListController::class, 'store'])->name('store-list');

    Route::get('create-item/{id}', [\App\Http\Controllers\ItemController::class, 'create'])->name('create-item');
    Route::get('show-item/{id}', [\App\Http\Controllers\ItemController::class, 'show'])->name('show-item');

    Route::post('create-item/store-item', [\App\Http\Controllers\ItemController::class, 'store'])->name('store-item');
    Route::get('edit-item/{id}', [\App\Http\Controllers\ItemController::class, 'edit'])->name('edit-item');
    Route::put('update-item/{id}', [\App\Http\Controllers\ItemController::class, 'update'])->name('update-item');
    Route::get('delete-items-image/{id}', [\App\Http\Controllers\ItemController::class, 'delete'])->name('delete-items-image');

    Route::get('create-tag{id}', [\App\Http\Controllers\ItemController::class, 'createTag'])->name('create-tag');
    Route::post('store-tag{id}', [\App\Http\Controllers\ItemController::class, 'storeTag'])->name('store-tag');

    Route::post('filter', [\App\Http\Controllers\ItemController::class, 'filterTag'])->name('filter');

    Route::get('roles',[\App\Http\Controllers\RoleController::class, 'index'])->name('roles');
    Route::get('roles-edit/{id}',[\App\Http\Controllers\RoleController::class, 'edit'])->name('roles-edit');
});
require __DIR__.'/auth.php';
