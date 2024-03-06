<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/event_page', [HomeController::class,'event'])->name('event');

Route::middleware('Auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('CheckisOrganizer')->group(function () {
    Route::get('/event', [EventController::class, 'create'])->name('event.create');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
});



Route::middleware('CheckisAdmin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('dashboard.categories');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('dashboard.categories.delete');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('dashboard.categories.store');

    Route::get('/users', [DashboardController::class, 'users'])->name('dashboard.users');
    Route::get('/users/delete/{id}', [DashboardController::class, 'delete_user'])->name('dashboard.users.delete');
    
    Route::get('/dashboard/events/pending', [EventController::class, 'events_pending'])->name('dashboard.events.pending');
    Route::get('/dashboard/events/refused', [EventController::class, 'events_refused'])->name('dashboard.events.refused');
    Route::get('/dashboard/events/accepted', [EventController::class, 'events_accepted'])->name('dashboard.events.accepted');
    Route::get('/dashboard/events/refuse_event/{id}', [EventController::class, 'refuse_event'])->name('dashboard.events.refuse_event');
    Route::get('/dashboard/events/validate_event/{id}', [EventController::class, 'validate_event'])->name('dashboard.events.validate_event');
    
});



require __DIR__.'/auth.php';
