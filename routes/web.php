<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;



Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/invitations/accept/{token}', [InvitationController::class, 'showAcceptForm'])->name('invitations.accept');
Route::post('/invitations/accept/{token}', [InvitationController::class, 'accept'])->name('invitations.accept.store');
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('companies', CompanyController::class);
    Route::get('/companies/{company}/users', [CompanyController::class, 'users'])->name('companies.users');

    Route::get('/invitations/create/{company?}', [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('/invitations/{company?}', [InvitationController::class, 'store'])->name('invitations.store');

    Route::get('/short-urls', [ShortUrlController::class, 'index'])->name('short-urls.index');
    Route::get('/short-urls/create', [ShortUrlController::class, 'create'])->name('short-urls.create');
    Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('short-urls.store');
});
Route::get('/{shortCode}', [ShortUrlController::class, 'redirect'])->name('short-urls.redirect');


