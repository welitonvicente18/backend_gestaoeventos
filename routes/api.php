<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\InscritoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/user', function (Request $request) {
//     return ['data' => ['id' => '1', 'name' => 'request->user()->name']];
// });

// User
// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::post('refresh', [AuthController::class, 'refresh']);
//     Route::post('me', [AuthController::class, 'me']);

// });


Route::post('login', [AuthController::class, 'login']);
Route::get('/login/validate', [AuthController::class, 'validate']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/usuario/index', [UserController::class, 'index']);

// Evento
Route::get('/evento/index', [EventoController::class, 'index'])->name('eventos.index');
Route::post('/evento/store', [EventoController::class, 'store'])->name('eventos.store');
Route::get('/evento/show/{id}', [EventoController::class, 'show'])->name('eventos.show');
Route::put('/evento/update/{id}', [EventoController::class, 'update'])->name('eventos.update');
Route::delete('/evento/destroy/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');


// Inscrito
Route::get('/inscrito/index', [InscritoController::class, 'index'])->name('inscritos.index');
Route::post('/inscrito/store', [InscritoController::class, 'store'])->name('inscritos.store');
Route::get('/inscrito/show/{id}', [InscritoController::class, 'show'])->name('inscritos.show');
Route::put('/inscrito/update/{id}', [InscritoController::class, 'update'])->name('inscritos.update');
Route::delete('/inscrito/destroy/{id}', [InscritoController::class, 'destroy'])->name('inscritos.destroy');