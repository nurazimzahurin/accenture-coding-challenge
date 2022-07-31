<?php

use App\Http\Controllers\CelebrityController;
use App\Http\Controllers\MovieCelebrityController;
use App\Http\Controllers\MovieController;
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

Route::get('/', function () {
    return redirect(route('movie-list'));
});

Route::get('/movie/list', [MovieController::class, 'get'])->name('movie-list');
Route::get('/movie/{movieID}', [MovieController::class, 'find']);
Route::post('/movie/create', [MovieController::class, 'create'])->name('movie-create');
Route::get('/movie/{movieID}/delete', [MovieController::class, 'delete']);
Route::post('/movie/{movieID}/edit', [MovieController::class, 'edit']);

Route::post('/movie/celebrity/create', [MovieCelebrityController::class, 'create']);

Route::get('/celebrity/list', [CelebrityController::class, 'getCelebrities']);
Route::post('/celebrity/create', [CelebrityController::class, 'create']);

