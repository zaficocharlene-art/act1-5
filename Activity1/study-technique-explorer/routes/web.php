<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyTechniqueController;

Route::get('/', function () {
    return redirect()->route('study-techniques.index');
});

// Study Techniques Routes
Route::get('/study-techniques', [StudyTechniqueController::class, 'index'])->name('study-techniques.index');
Route::get('/study-techniques/{id}', [StudyTechniqueController::class, 'show'])->name('study-techniques.show');