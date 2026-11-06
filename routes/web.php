<?php

use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Models\Lesson;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/begeleider/dashboard', function () {
    $lessen = Lesson::where('begeleider_id', auth()->id())
        ->orderBy('datum')
        ->orderBy('begintijd')
        ->get();

    return view('begeleider.dashboard', compact('lessen'));
})->middleware(['auth', 'begeleider'])->name('begeleider.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::get('/lessen', [LessonController::class, 'index'])
    ->middleware('auth')
    ->name('lessen.index');

// Alleen een beheerder kan lessen aanmaken of verwijderen.
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/lessen/aanmaken', [LessonController::class, 'create'])
        ->name('lessen.aanmaken');

    Route::post('/lessen/aanmaken', [LessonController::class, 'store'])
        ->name('lessen.opslaan');

    Route::delete('/lessen/{lesson}', [LessonController::class, 'destroy'])
        ->name('lessen.verwijderen');
});

// Inschrijvingen.
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