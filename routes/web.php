<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\fileController;

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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('uploadFile', [fileController::class, 'index'])->name('uploadFile');
Route::post('upload', [fileController::class, 'store'])->name('store');
Route::get('dashboard', [fileController::class, 'dashboard'])->name('dashboard');
Route::get('edit/{id}', [fileController::class, 'edit'])->name('edit');
Route::post('update/{id}', [fileController::class, 'update'])->name('update');
Route::get('delete{id}', [fileController::class, 'destroy'])->name('delete');
