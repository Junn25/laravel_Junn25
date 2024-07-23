<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\Auth\LoginController;


Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::resource('hospitals', HospitalController::class);
Route::resource('patients', PatientController::class);
Route::get('patients/filter', [PatientController::class, 'filter'])->name('patients.filter');
