<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Therapy page
Route::get('/therapy', function () {
    return view('pages.TherapyPage');
})->name('therapy');

// Pain Management page
Route::get('/pain-management', function () {
    return view('pages.pain-management');
})->name('pain-management');

// Clinics page
Route::get('/clinics', function () {
    return view('pages.clinics');
})->name('clinics');

// About page
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Blog page
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::post('/appointments', [AppointmentController::class, 'store'])->name(
    'appointments.store'
);
