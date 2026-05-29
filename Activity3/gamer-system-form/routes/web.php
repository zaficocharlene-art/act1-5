<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamerController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [GamerController::class, 'dashboard']);

Route::get('/reaction/create', [GamerController::class, 'create']);
Route::post('/reaction', [GamerController::class, 'store']);

Route::get('/reaction/delete/{id}', [GamerController::class, 'delete']);