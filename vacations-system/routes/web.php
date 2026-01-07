<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\VacationController;
use App\Http\Controllers\Admin\TransportTypeController;
use App\Http\Controllers\Admin\OrganizerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Public\VacationController as PublicVacationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicVacationController::class, 'index'])->name('home');
Route::get('/vacations', [PublicVacationController::class, 'index'])->name('public.vacations.index');
Route::get('/vacations/{vacation}', [PublicVacationController::class, 'show'])->name('public.vacations.show');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('vacations', VacationController::class);
    Route::resource('transport-types', TransportTypeController::class);
    Route::resource('organizers', OrganizerController::class);
    Route::resource('users', UserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});