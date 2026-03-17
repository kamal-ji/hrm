<?php

use App\Http\Controllers\Backend\AllowanceController;
use App\Http\Controllers\Backend\BusinessController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\DesignationController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\ImpersonationController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/forgot-password', [AuthController::class, 'showForgotpassword'])->name('forgot-password');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/forgotpassword', [AuthController::class, 'Forgotpassword'])->name('forgotpassword.submit');
Route::get('/getstates/{countryId}', [LocationController::class, 'getStatesByCountry'])->name('getstates');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin routes
Route::middleware(['auth', 'role:admin|member|employee|staff|business_owner'])->prefix('admin')->group(function () {
    Route::get('/impersonate/stop', [ImpersonationController::class, 'stopImpersonation'])->name('impersonate.stop');
    Route::get('/impersonate/{user}', [ImpersonationController::class, 'impersonate'])->name('impersonate.start');
    
    // Company settings
    Route::get('/profile/company-setting', [ProfileController::class, 'Companysetting'])->name('profile.company-setting');
    Route::post('/profile/company-setting', [ProfileController::class, 'SaveCompanysetting'])->name('save.companysettings');
    Route::get('/company-settings/delete-logo', [ProfileController::class, 'deleteCompanyLogo'])->name('delete.companylogo');
    Route::get('/company-settings/delete-favicon', [ProfileController::class, 'deleteCompanyFavicon'])->name('delete.companyfavicon');
    Route::get('/profile/email-setting', [ProfileController::class, 'Emailsetting'])->name('profile.email-setting');

    // Employee Routes
    Route::prefix('employee')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    });

    // Business Routes
    Route::prefix('business')->group(function () {
        Route::get('/', [BusinessController::class, 'index'])->name('business.index');
        Route::get('/create', [BusinessController::class, 'create'])->name('business.create');
        Route::post('/', [BusinessController::class, 'store'])->name('business.store');
        Route::get('/{id}/edit', [BusinessController::class, 'edit'])->name('business.edit');
        Route::put('/{id}', [BusinessController::class, 'update'])->name('business.update');
    });

    // Staff Routes
    Route::prefix('staff')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::put('/{id}', [StaffController::class, 'update'])->name('staff.update');
    });

    Route::prefix('department')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('department.index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('/', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::get('/{id}/delete', [DepartmentController::class, 'destroy'])->name('department.destroy');
        Route::put('/{id}', [DepartmentController::class, 'update'])->name('department.update');
    });

    Route::prefix('designation')->group(function () {
        Route::get('/', [DesignationController::class, 'index'])->name('designation.index');
        Route::get('/create', [DesignationController::class, 'create'])->name('designation.create');
        Route::post('/', [DesignationController::class, 'store'])->name('designation.store');
        Route::get('/{id}/edit', [DesignationController::class, 'edit'])->name('designation.edit');
        Route::get('/{id}/delete', [DesignationController::class, 'destroy'])->name('designation.destroy');
        Route::put('/{id}', [DesignationController::class, 'update'])->name('designation.update');
    });

    Route::prefix('allowance')->group(function () {
        Route::get('/', [AllowanceController::class, 'index'])->name('allowance.index');
        Route::get('/create', [AllowanceController::class, 'create'])->name('allowance.create');
        Route::post('/', [AllowanceController::class, 'store'])->name('allowance.store');
        Route::get('/{id}/edit', [AllowanceController::class, 'edit'])->name('allowance.edit');
        Route::get('/{id}/delete', [AllowanceController::class, 'destroy'])->name('allowance.destroy');
        Route::put('/{id}', [AllowanceController::class, 'update'])->name('allowance.update');
    });
});

// OTP Verification (Protected)
Route::middleware(['otp.requested'])->group(function () {
    Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify-otp');
    Route::post('/verifyotp', [AuthController::class, 'verifyOtp'])->name('verifyotp.submit');
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');
});

// Reset Password (Protected)
// Reset password
Route::middleware(['otp.verified'])->group(function () {
    Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset.password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password.submit');
});
