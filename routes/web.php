<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/begeleider/dashboard', function () {
    return view('begeleider.dashboard');
})->middleware(['auth', 'begeleider']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/lessen', [LessonController::class, 'index'])
    ->middleware('auth')
    ->name('lessen.index');

    Route::get('/lessen/aanmaken', [LessonController::class, 'create'])
   ->middleware(['auth', 'begeleider']);

    Route::post('/lessen/aanmaken', [LessonController::class, 'store'])
    ->middleware(['auth', 'begeleider']);

    Route::post('/lessen/{lesson}/inschrijven', [EnrollmentController::class, 'store'])
    ->middleware('auth')
    ->name('lessen.inschrijven');

    Route::get('/mijn-inschrijvingen', [EnrollmentController::class, 'mijnInschrijvingen'])
    ->middleware('auth')
    ->name('lessen.mijn-inschrijvingen');

    Route::delete('/inschrijvingen/{enrollment}', [EnrollmentController::class, 'annuleren'])
    ->middleware('auth')
    ->name('inschrijvingen.annuleren');
    
require __DIR__.'/auth.php';
