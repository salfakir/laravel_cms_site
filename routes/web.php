<?php

use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', [App\Http\Controllers\testController::class, 'test'])->name('test');
Route::get('/test2', [App\Http\Controllers\testController::class, 'test2'])->name('test2');
Route::get('/test3', [App\Http\Controllers\testController::class, 'test3'])->name('test3');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
