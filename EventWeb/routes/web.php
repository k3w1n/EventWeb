<?php

use App\Http\Controllers\AttendingEventController;
use App\Http\Controllers\AttendingSystemController;
use App\Http\Controllers\DeleteCommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventIndexController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryIndexController;
use App\Http\Controllers\LikedEventController;
use App\Http\Controllers\LikeSystemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedEventController;
use App\Http\Controllers\SaveSystemController;
use App\Http\Controllers\StoreCommentController;
use App\Http\Controllers\TestEventController;
use App\Http\Controllers\WelcomeController;
use App\Models\Country;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|   Nama : Erwin Johannes
    NIM : 10121223
    Kelas : IF-6
|
*/

Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::get('/e/{id}', EventShowController::class)->name('eventShow');
Route::get('/gallery', GalleryIndexController::class)->name('galleryIndex');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/events', EventController::class);
    Route::resource('/galleries', GalleryController::class);

    Route::get('/like-events', LikedEventController::class)->name('likedEvents');
    Route::get('/save-events', SavedEventController::class)->name('savedEvents');
    Route::get('/attending-events', AttendingEventController::class)->name('attendingEvents');

    Route::post('/events-like/{id}', LikeSystemController::class)->name('events.like');
    Route::post('/events-save/{id}', SaveSystemController::class)->name('events.save');
    Route::post('/events-attending/{id}', AttendingSystemController::class)->name('events.attending');

    Route::post('/events/{id}/comments', StoreCommentController::class)->name('events.comments');
    Route::delete('/events/{id}/comments/{comment}', DeleteCommentController::class)->name('events.comments.destroy');
    Route::get('/countries/{country}', function (Country $country) {
        return response()->json($country->cities);
    });
});

require __DIR__.'/auth.php';
