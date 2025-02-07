<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NytController;
use App\Http\Controllers\NewsapiController;
use App\Http\Controllers\ProfileController;

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
});


Route::get('/nyt', [NytController::class, 'index'])->name('nyt.index');
Route::get('/newsapi', [NewsapiController::class, 'index'])->name('newsapi.index');
Route::post('/newsapi', [NewsapiController::class, 'getData'])->name('newsapi.post');



require __DIR__.'/auth.php';
