<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TravelSignupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});
Route::get('/dashboard', [DestinationController::class, 'index'])->name('dashboard');

Route::resource('/destinations', DestinationController::class);
Route::resource('/destinations/{destination}/travels', TravelController::class);
// Route::resource('/travel-signups', TravelSignupController::class)->middleware(['auth']);
// Route::resource('/admin/users', App\Http\Controllers\Admin\User\UserController::class)->middleware(IsAdminMiddleware::class);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::group([
//     'prefix'     => 'admin',
//     'as'         => 'admin.',
//     'namespace'  => 'App\Http\Controllers\Admin',
//     'middleware' => [IsAdminMiddleware::class],
// ], function () {
//     Route::resource('albums', \AlbumController::class);
//     Route::resource('labels', \LabelController::class);
//     Route::resource('artists', \ArtistController::class);
// });

require __DIR__.'/auth.php';
