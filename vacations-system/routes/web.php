<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\VacationController;
use App\Http\Controllers\Admin\TransportTypeController;
use App\Http\Controllers\Admin\OrganizerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Public\VacationController as PublicVacationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/api/locations', function(Request $request) {
    $search = $request->get('q', '');
    
    if (strlen($search) < 2) {
        return response()->json([]);
    }
    
    $vacations = \App\Models\Vacation::where('country', 'like', "%{$search}%")
        ->orWhere('city', 'like', "%{$search}%")
        ->limit(10)
        ->get();
    
    $locations = $vacations->flatMap(function($vacation) {
        $result = [];
        if ($vacation->country && stripos($vacation->country, request('q')) !== false) {
            $result[] = [
                'id' => $vacation->id,
                'name' => $vacation->country,
                'city_id' => $vacation->id,
            ];
        }
        if ($vacation->city && stripos($vacation->city, request('q')) !== false) {
            $result[] = [
                'id' => $vacation->id,
                'name' => $vacation->city,
                'city_id' => $vacation->id,
            ];
        }
        return $result;
    })->unique('name')->values();
    
    return response()->json($locations);
})->name('api.locations');

Route::get('/', [PublicVacationController::class, 'index'])->name('home');
Route::get('/vacations', [PublicVacationController::class, 'index'])->name('public.vacations.index');
Route::get('/vacations/{vacation}', [PublicVacationController::class, 'show'])->name('public.vacations.show');
Route::get('/offers', [PublicVacationController::class, 'offers'])->name('public.offers');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('vacations', \App\Http\Controllers\Admin\VacationController::class);
    Route::resource('transport-types', \App\Http\Controllers\Admin\TransportTypeController::class);
    Route::resource('organizers', \App\Http\Controllers\Admin\OrganizerController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});