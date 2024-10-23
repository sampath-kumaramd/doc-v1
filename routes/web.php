<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DoctorRegisterController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\DocuSignController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Doctor routes
Route::get('/doctor/register', [DoctorRegisterController::class, 'showRegistrationForm'])->name('doctor.register');
Route::post('/doctor/register', [DoctorRegisterController::class, 'register']);
Route::get('/doctor/agreement', [DoctorController::class, 'showAgreement'])->name('doctor.agreement');
Route::post('/doctor/agreement', [DoctorController::class, 'submitAgreement'])->name('doctor.submit-agreement');
Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/doctor/{id}', [AdminController::class, 'viewDoctor'])->name('admin.view-doctor');
    Route::post('/admin/doctor/{id}/approve', [AdminController::class, 'approveDoctor'])->name('admin.approve-doctor');
    Route::post('/admin/doctor/{id}/reject', [AdminController::class, 'rejectDoctor'])->name('admin.reject-doctor');
    Route::get('/admin/terms-and-conditions', [AdminController::class, 'showTermsAndConditions'])->name('admin.terms-and-conditions');
    Route::post('/admin/terms-and-conditions', [AdminController::class, 'updateTermsAndConditions']);
    Route::get('/admin/doctor/{id}/agreement-pdf', [PdfController::class, 'generateAgreementPdf'])->name('admin.agreement-pdf');
});

// OTP routes
Route::post('/otp/send', [OtpController::class, 'sendOtp'])->name('otp.send');
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');

// DocuSign routes
Route::post('/docusign/create-envelope', [DocuSignController::class, 'createEnvelope'])->name('docusign.create-envelope');
