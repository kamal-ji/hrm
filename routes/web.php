<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\CustomerController;

use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\LocationController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/forgot-password', [AuthController::class, 'showForgotpassword'])->name('forgot-password');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/forgotpassword', [AuthController::class, 'Forgotpassword'])->name('forgotpassword.submit');
Route::get('/getstates/{countryId}', [LocationController::class, 'getStatesByCountry'])->name('getstates');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Protected routes using external auth
// Routes accessible by any authenticated user
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin routes
Route::middleware(['auth', 'role:admin|member|employee'])->prefix('admin')->group(function () {

    // Company settings
    Route::get('/profile/company-setting', [ProfileController::class, 'Companysetting'])->name('profile.company-setting');
    Route::post('/profile/company-setting', [ProfileController::class, 'SaveCompanysetting'])->name('save.companysettings');
    Route::get('/company-settings/delete-logo', [ProfileController::class, 'deleteCompanyLogo'])->name('delete.companylogo');
    Route::get('/company-settings/delete-favicon', [ProfileController::class, 'deleteCompanyFavicon'])->name('delete.companyfavicon');
    Route::get('/profile/email-setting', [ProfileController::class, 'Emailsetting'])->name('profile.email-setting');
    
    
    
    // Members Routes
Route::prefix('members')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('members.index');
    Route::get('/active', [MemberController::class, 'active'])->name('members.active');
    Route::get('/inactive', [MemberController::class, 'inactive'])->name('members.inactive');
    Route::get('/pending', [MemberController::class, 'pending'])->name('members.pending'); // New Registrations
    Route::get('/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/', [MemberController::class, 'store'])->name('members.store');
    Route::get('/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::get('/sponsor-details', [MemberController::class, 'getSponsorDetails'])
    ->name('members.sponsor.details');
    // Bulk operations
    Route::post('/bulk-approve', [MemberController::class, 'bulkApprove'])->name('members.bulk.approve');
    Route::post('/bulk-delete', [MemberController::class, 'bulkDelete'])->name('members.bulk.delete');
    Route::put('/{member}/status', [MemberController::class, 'updateStatus'])->name('members.status.update');
    Route::post('/{member}/approve', [MemberController::class, 'approve'])->name('members.approve');
    Route::post('/{member}/reject', [MemberController::class, 'reject'])->name('members.reject');
});

   // employees Routes
Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/active', [EmployeeController::class, 'active'])->name('employees.active');
    Route::get('/inactive', [EmployeeController::class, 'inactive'])->name('employees.inactive');
    Route::get('/pending', [EmployeeController::class, 'pending'])->name('employees.pending'); // New Registrations
    Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('/sponsor-details', [EmployeeController::class, 'getSponsorDetails'])
    ->name('employees.sponsor.details');
    // Bulk operations
    Route::post('/bulk-approve', [EmployeeController::class, 'bulkApprove'])->name('employees.bulk.approve');
    Route::post('/bulk-delete', [EmployeeController::class, 'bulkDelete'])->name('employees.bulk.delete');
    Route::put('/{employee}/status', [EmployeeController::class, 'updateStatus'])->name('employees.status.update');
    Route::post('/{employee}/approve', [EmployeeController::class, 'approve'])->name('employees.approve');
    Route::post('/{employee}/reject', [EmployeeController::class, 'reject'])->name('employees.reject');
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
