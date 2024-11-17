<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationMgmtController;

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeController;

use App\Models\Facilities;
use App\Models\User;
use App\Models\AdminSignature;



Route::get('/', [HomeController::class, 'homepage']);



Route::middleware(['auth'])->group(function () {

    Route::get('/{role_id}/admin-dashboard', [AuthenticationController::class, 'dashboard'])->name('dashboard');

    Route::post('', [AuthenticationController::class, 'login']);
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:1,2,3'])->group(function () {
    Route::get('/{role_id}/admin-facilities', [FacilitiesController::class, 'listFacilities'])->name('admin.facilities');
    Route::get('/{role_id}/admin-reservation/{isArchived?}', [ReservationController::class, 'listReservations'])
    ->name('admin.reservation');
    Route::delete('/{role_id}/admin-reservation/{reservedetailsID}', [ReservationMgmtController::class, 'deleteReservation'])->name('reservation.destroy');
    Route::get('/{role_id}/admin-calendar', [CalendarController::class, 'showCalendar'])->name('dashboard.calendar');
    Route::put('/profile/update/{role_id}/{id}', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/{role_id}/admin-reservation/approvals', [ReservationMgmtController::class, 'updateApproval'])->name('admin.approvals.store');
});

Route::post('/facilities/save', [FacilitiesController::class, 'addFacility'])->name('facility.save');
Route::put('/facilities/{facilityID}', [FacilitiesController::class, 'editFacility'])->name('facilities.update');
Route::delete('/facilities/{facilityID}', [FacilitiesController::class, 'deleteFacility'])->name('facilities.destroy');
Route::get('/reservationsQuery', [CalendarController::class, 'getReservationsByRole'])->name('dashboard.reservations');

Route::post('/admin/send-reservee-email', [ReservationMgmtController::class, 'sendReserveeEmail'])->name('admin.sendReserveeEmail');


Route::get('/cancel-reservation/{reserveeID}', [ReservationController::class, 'cancelReservation'])->name('cancel.reservation');
Route::post('/update-status', [ReservationController::class, 'updateStatus'])->name('update.status');


Route::get('/facilitiesQuery', [CalendarController::class, 'getFacilitiesByRole'])->name('dashboard.facilities');

Route::get('/confirmation/{token}', [ReservationMgmtController::class, 'confirmEndorsement'])->name('confirm.endorsement');

Route::get('/calendar', [CalendarController::class, 'showCalendarPage'])->name('calendar');

Route::get('/reservations/{reserveeID}/status', [ReservationController::class, 'fetchStatus']);
Route::get('/make-reservation', [ReservationController::class, 'showReservationForm'])->name('make-reservation');
Route::post('', [ReservationController::class, 'storeReservations'])->name('reservation.store');

Route::match(['get', 'post'], '/insert-admin-user', [AuthenticationController::class, 'insertAdmin']);

Route::get('/door', [AuthenticationController::class, 'DisplayLoginForm'])->name('login');

Route::post('/door', [AuthenticationController::class, 'login']);

Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');


require __DIR__.'/auth.php';
