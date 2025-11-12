<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClinicsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PainTechniqueController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\TherapyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
// Home page
// routes/web.php
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name(
    'home'
);

// Therapy page
Route::get('/therapy', [TherapyController::class, 'index'])->name('therapy');
Route::get('/therapies/{slug}', [TherapyController::class, 'show'])->name(
    'therapies.show'
);
// Pain Management page
Route::get('/treatments/{slug}', [
    PainTechniqueController::class,
    'show',
])->name('treatments.show');

Route::get('/pain-management', [PainTechniqueController::class, 'index'])->name(
    'pain-management'
); // Clinics page
Route::get('/clinics', [ClinicsController::class, 'index'])->name('clinics');

// About page
Route::get('/about', [TeamMemberController::class, 'index'])->name('about');
Route::get('/articles', [ArticleController::class, 'index'])->name(
    'articles.index'
);
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name(
    'articles.show'
);
// Blog page
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [ArticleController::class, 'show'])->name(
    'blog.blog-show'
);
Route::post('/appointments', [AppointmentController::class, 'store'])
    ->name('appointments.store');

Route::fallback(function () {
    Log::warning('Fallback route redirected to home: ' . request()->method() . ' ' . request()->path());
    return redirect()->route('home');
});