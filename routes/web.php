<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Admin\AdmitCardController;
use App\Http\Controllers\Admin\AnswerKeyController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/search', [JobController::class, 'search'])->name('jobs.search');
Route::get('/categories', [JobController::class, 'categories'])->name('categories');
Route::get('/jobs/{category}', [JobController::class, 'category'])->name('jobs.category');
Route::get('/job/{jobPost}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/admit-cards', [JobController::class, 'admitCards'])->name('admit-cards');
Route::get('/answer-keys', [JobController::class, 'answerKeys'])->name('answer-keys');
Route::get('/latest-jobs', [JobController::class, 'latestJobs'])->name('latest-jobs');
Route::get('/results', [JobController::class, 'results'])->name('results');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(array_filter(['auth', config('mail.verification.required', true) ? 'verified' : null]))->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('job-posts', JobPostController::class);
    Route::resource('admit-cards', AdmitCardController::class);
    Route::resource('answer-keys', AnswerKeyController::class);
    
    // Admin Profile Routes
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [AdminProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');
});

require __DIR__.'/auth.php';
