<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TasksController;
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

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [ProjectController::class, 'index'])->name('home');
    Route::get('/projectdetails/{id}', [ProjectController::class, 'show'])->name('projectdetails');

    Route::get('/tasks', [TasksController::class, 'index'])->name('home');
    Route::get('/taskdetails/{id}', [TasksController::class, 'show'])->name('taskdetails');
});
