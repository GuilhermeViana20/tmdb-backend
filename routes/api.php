<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\GenreController;

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/search', [MovieController::class, 'search']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::post('/movies/{id}', [MovieController::class, 'store']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);
Route::get('/genres', [GenreController::class, 'index']);
