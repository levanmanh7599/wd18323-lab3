<?php

use App\Http\Middleware\CheckTokenMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/movies/create', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/edit/{movie}', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('/movies/edit/{movie}', [MovieController::class, 'update'])->name('movies.update');
Route::delete('/movies/delete/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
Route::get('/search', [MovieController::class, 'search'])->name('movies.search');




