<?php

use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', [App\Http\Controllers\testController::class, 'test'])->name('test');
Route::get('/test2', [App\Http\Controllers\testController::class, 'test2'])->name('test2');
Route::get('/test3', [App\Http\Controllers\testController::class, 'test3'])->name('test3');
Route::get('/test4', [App\Http\Controllers\testController::class, 'test4'])->name('test4');
Route::get('/test5', [App\Http\Controllers\testController::class, 'test5'])->name('test5');
Route::get('/test6', [App\Http\Controllers\testController::class, 'test6'])->name('test6');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
