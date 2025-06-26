<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Category pages
Route::get('/jobs', function () {
    return view('pages.jobs');
});

Route::get('/results', function () {
    return view('pages.results');
});

Route::get('/admit-cards', function () {
    return view('pages.admit-cards');
});

Route::get('/admissions', function () {
    return view('pages.admissions');
});

Route::get('/answer-keys', function () {
    return view('pages.answer-keys');
});

Route::get('/syllabus', function () {
    return view('pages.syllabus');
});

Route::get('/sarkari-yojana', function () {
    return view('pages.sarkari-yojana');
});

// Static pages
Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/privacy-policy', function () {
    return view('pages.privacy-policy');
});

Route::get('/disclaimer', function () {
    return view('pages.disclaimer');
});

Route::get('/terms', function () {
    return view('pages.terms');
});

// Regular forms
Route::get('/regular-form', function () {
    return view('pages.regular-form');
});
