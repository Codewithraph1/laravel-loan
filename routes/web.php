<?php

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AccountDetailController;
use App\Http\Controllers\Admin\AdminLoanController as AdminLoanController;
use App\Http\Controllers\Admin\AdminPaymentController as AdminPaymentController;


// User Controllers
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\UserDashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController as ProfileController;
use App\Http\Controllers\User\LoanController as LoanController;
use App\Http\Controllers\User\PaymentController as PaymentController;
use App\Http\Controllers\User\LoanHistoryController as LoanHistoryController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Front-End Routes
Route::get('/', function () {
    return view('front.index');
})->name('home');
Route::get('about', function () {
    return view('front.about');
})->name('about');

Route::get('loan', function () {
    return view('front.loan');
})->name('loan');

Route::get('contact', function () {
    return view('front.contact');
})->name('contact');
Route::get('terms', function () {
    return view('front.terms');
})->name('terms');
Route::get('privacy', function () {
    return view('front.privacy');
})->name('privacy');
Route::get('faq', function () {
    return view('front.faq');
})->name('faq');
Route::get('testimony', function () {
    return view('front.testimony');
})->name('testimony');









// Admin Routes
Route::prefix('admin')->group(function () {
    // Authentication Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Protected Dashboard Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Settings Routes
        Route::get('/settings', [SettingController::class, 'edit'])->name('admin.settings.edit');
        Route::put('/settings/profile', [SettingController::class, 'update'])->name('admin.settings.update');
        Route::put('/settings/password', [SettingController::class, 'updatePassword'])->name('admin.settings.password');

        // User Management Routes
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
            Route::get('/{user}', [UserController::class, 'show'])->name('admin.users.show');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('admin.users.update');
            Route::put('/{user}/status', [UserController::class, 'updateStatus'])->name('admin.users.update-status');
            Route::put('/{user}/toggle-verification', [UserController::class, 'toggleVerification'])->name('admin.users.toggle-verification');
            Route::put('/{user}/password', [UserController::class, 'updatePassword'])->name('admin.users.update-password');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        });

        // Admin Account Details Routes
        Route::prefix('account-details')->group(function () {
            Route::get('/', [AccountDetailController::class, 'index'])->name('admin.accounts.index');
            Route::get('/create', [AccountDetailController::class, 'create'])->name('admin.accounts.create');
            Route::post('/', [AccountDetailController::class, 'store'])->name('admin.accounts.store');
            Route::get('/{account}/edit', [AccountDetailController::class, 'edit'])->name('admin.accounts.edit');
            Route::put('/{account}', [AccountDetailController::class, 'update'])->name('admin.accounts.update');
            Route::put('/{account}/toggle-status', [AccountDetailController::class, 'toggleStatus'])->name('admin.accounts.toggle-status');
            Route::delete('/{account}', [AccountDetailController::class, 'destroy'])->name('admin.accounts.destroy');
        });

        Route::get('/loans', [AdminLoanController::class, 'index'])->name('admin.loans.index');
        Route::get('/loans/status/{status}', [AdminLoanController::class, 'byStatus'])->name('admin.loans.by-status');
        Route::get('/loans/{id}', [AdminLoanController::class, 'show'])->name('admin.loans.show');
        Route::post('/loans/{id}/approve', [AdminLoanController::class, 'approve'])->name('admin.loans.approve');
        Route::post('/loans/{id}/reject', [AdminLoanController::class, 'reject'])->name('admin.loans.reject');
        Route::post('/loans/{id}/disburse', [AdminLoanController::class, 'disburse'])->name('admin.loans.disburse');
        Route::put('/loans/{id}', [AdminLoanController::class, 'update'])->name('admin.loans.update');



        Route::get('/payments/pending', [AdminPaymentController::class, 'pendingPayments'])->name('admin.payments.pending');
        Route::get('/payments', [AdminPaymentController::class, 'allPayments'])->name('admin.payments.index');
        Route::get('/payments/{id}', [AdminPaymentController::class, 'showPayment'])->name('admin.payments.show');
        Route::post('/payments/{id}/approve', [AdminPaymentController::class, 'approvePayment'])->name('admin.payments.approve');
        Route::post('/payments/{id}/reject', [AdminPaymentController::class, 'rejectPayment'])->name('admin.payments.reject');
    });
});



// User Routes
Route::prefix('user')->group(function () {
    // Authentication Routes
    Route::get('/register', [UserAuthController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');


    // Protected Dashboard Routes
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    });

    Route::get('/loan-history', [LoanHistoryController::class, 'index'])->name('user.loan-history');
  
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'profile'])->name('user.profile');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('user.settings');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('user.profile.update');
    Route::put('/email/update', [ProfileController::class, 'updateEmail'])->name('user.email.update');
    Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('user.password.update');


    // User Loan Routes
    Route::get('/loans', [LoanController::class, 'index'])->name('user.loans.index');
    Route::get('/loans/apply', [LoanController::class, 'create'])->name('user.loans.create');
    Route::post('/loans/apply', [LoanController::class, 'store'])->name('user.loans.store');
    Route::get('/loans/{id}', [LoanController::class, 'show'])->name('user.loans.show');

    Route::get('/loans/{id}/agreement', [LoanController::class, 'downloadAgreement'])->name('user.loans.agreement');
    Route::post('/loans/{id}/cancel', [LoanController::class, 'cancel'])->name('user.loans.cancel');


    Route::get('/loans/{id}/pay', [PaymentController::class, 'create'])->name('user.payments.create');
    Route::post('/loans/{id}/pay', [PaymentController::class, 'store'])->name('user.payments.store');
    Route::get('/loans/{id}/payments', [PaymentController::class, 'loanPayments'])->name('user.payments.history');
});
