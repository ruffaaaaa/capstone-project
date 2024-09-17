<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CalendarController;

use App\Models\Facilities;


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

Route::get('/', function () {
    return view('index');
});
Route::get('/', [FacilitiesController::class, 'homeFacilities']);

Route::middleware(['auth'])->group(function () {

    Route::get('/admin-dashboard', [AuthenticationController::class, 'adminDashboard'])->name('adminDashboard');

    Route::post('', [AuthenticationController::class, 'login']);
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    //facilities
    Route::get('/admin-facilities', function () {
        $facilities = Facilities::all();
        return view('dashboard.admin.facilities', compact('facilities'));
    })->name('admin.facilities');
    Route::post('/facilities/save', [FacilitiesController::class, 'createFacility'])->name('facility.save');
    Route::put('/facilities/{facilityID}', [FacilitiesController::class, 'updateFacility'])->name('facilities.update');
    Route::delete('/facilities/{facilityID}', [FacilitiesController::class, 'destroyFacility'])->name('facilities.destroy');

    //reservationmgmt
    Route::get('/admin-reservation', function () {
        return view('dashboard.admin.reservationmgmt');
    });
    Route::get('/admin-reservation', [ReservationController::class, 'adminReservation'])->name('admin-reservation');
    Route::delete('/admin-reservation/{reservedetailsID}', [ReservationController::class, 'destroyReservation'])->name('reservation.destroy');
    Route::put('/admin-reservation/{reserveeID}', [ReservationController::class, 'updateReservation'])->name('update.reservee');

    //calendar-admin
    Route::get('/reservations', [CalendarController::class, 'getReservations']);
    Route::get('/admin-calendar', [CalendarController::class, 'showCalendar']);
    Route::get('/facilities', [CalendarController::class, 'getFacilities']);

    //admin-profile
    Route::get('admin-profile', [ProfileController::class, 'showProfile'])->name('admin-profile');

});

//user
Route::get('/make-reservation', [ReservationController::class, 'showReservationForm'])->name('make-reservation');
Route::post('', [ReservationController::class, 'storeReservations'])->name('reservation.store');



Route::get('/login', [AuthenticationController::class, 'DisplayLoginForm'])->name('login');

Route::post('/login', [AuthenticationController::class, 'login']);

require __DIR__.'/auth.php';
