<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostFoundController;

Route::get('/', [LostFoundController::class, 'home'])->name('home');
Route::get('/board', [LostFoundController::class, 'board'])->name('board');
Route::get('/post', [LostFoundController::class, 'create'])->name('items.create');
Route::post('/post', [LostFoundController::class, 'store'])->name('items.store');
Route::get('/dashboard', [LostFoundController::class, 'dashboard'])->name('dashboard');
Route::get('/items/{item}', [LostFoundController::class, 'show'])->name('items.show');
Route::patch('/items/{item}/status', [LostFoundController::class, 'updateStatus'])->name('items.status');
Route::delete('/items/{item}', [LostFoundController::class, 'destroy'])->name('items.destroy');