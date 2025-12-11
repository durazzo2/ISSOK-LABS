<?php

use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/events');
});

// Organizer CRUD
Route::resource('organizers', OrganizerController::class);

// Event CRUD
Route::resource('events', EventController::class);

// Event search
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
