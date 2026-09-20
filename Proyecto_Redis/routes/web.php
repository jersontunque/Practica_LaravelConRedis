<?php


use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/objetos', [TicketsController::class, 'index'])->name('objetos.index');
Route::get('/objetos-redis', [TicketsController::class, 'indexRedis'])->name('objetos.redis');