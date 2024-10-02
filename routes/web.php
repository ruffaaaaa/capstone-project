<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CalendarController;

use App\Models\Facilities;
use App\Models\User;
use App\Models\AdminSignature;




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

    Route::get('/east-dashboard', [AuthenticationController::class, 'eastDashboard'])->name('eastDashboard')->middleware('role:1');
    Route::get('/admin-dashboard', [AuthenticationController::class, 'gso_cissoDashboard'])
    ->name('dashboard')
    ->middleware('role:2,3');
    Route::post('', [AuthenticationController::class, 'login']);
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});


//east
Route::middleware(['auth', 'role:1'])->group(function () {
    // facilities
    Route::get('/east-facilities', function () {
        $facilities = Facilities::all();
        $user = Auth::user(); 
        $signature = AdminSignature::where('admin_id', $user->id)->first();

        return view('dashboard.east.facilities', compact('facilities', 'user', 'signature'));
    })->name('admin.facilities');

    Route::post('/facilities/save', [FacilitiesController::class, 'createFacility'])->name('facility.save');
    Route::put('/facilities/{facilityID}', [FacilitiesController::class, 'updateFacility'])->name('facilities.update');
    Route::delete('/facilities/{facilityID}', [FacilitiesController::class, 'destroyFacility'])->name('facilities.destroy');

    //reservationmgmt
    Route::get('/east-reservation', function () {
        return view('dashboard.east.reservationmgmt');
    });
    Route::get('/east-reservation', [ReservationController::class, 'eastReservation'])->name('east-reservation');
    Route::delete('/east-reservation/{reservedetailsID}', [ReservationController::class, 'eastDestroy'])->name('reservation.destroy');
    // Route::put('/east-reservation/{approvalID}', [ReservationController::class, 'update'])->name('update.reservee');

    //calendar-east
    Route::get('/east-calendar', [CalendarController::class, 'showEASTCalendar']);

    Route::get('/reservations', [CalendarController::class, 'getEASTReservations']);
    Route::get('/facilities', [CalendarController::class, 'getEASTFacilities']);

    //admin-profile
    Route::put('/eastprofile/update/{id}', [ProfileController::class, 'updateEastProfile'])->name('profile.update');
    Route::post('/east-reservation/approvals', [ReservationController::class, 'eastStore'])->name('admin.approvals.eastStore');


});

Route::middleware(['auth', 'role:2,3'])->group(function() {
    // Make sure this route has a unique path
    Route::get('/admin-reservation', [ReservationController::class, 'gso_cissoReservation'])->name('gso-cisso-reservation');
    Route::post('/admin-reservation/approvals', [ReservationController::class, 'gso_cissoStore'])->name('admin.approvals.adminStore');


    // Other routes related to reservations and calendars
    Route::get('/admin-calendar', [CalendarController::class, 'showGSO_CISSOCalendar']);
    Route::get('/admin-reservations', [CalendarController::class, 'getGSO_CISSOReservations']);
    Route::get('/admin-facilities', [CalendarController::class, 'getGSO_CISSOFacilities']);
    Route::put('/adminprofile/update/{id}', [ProfileController::class, 'updateGSO_CISSOProfile'])->name('gso-cisso.profile.update');

});

Route::get('/confirmation/{token}', [ReservationController::class, 'confirmEndorsement'])->name('confirm.endorsement');

    
Route::get('/make-reservation', [ReservationController::class, 'showReservationForm'])->name('make-reservation');
Route::post('', [ReservationController::class, 'storeReservations'])->name('reservation.store');

Route::match(['get', 'post'], '/insert-admin-user', [AuthenticationController::class, 'insertAdmin']);

Route::get('/login', [AuthenticationController::class, 'DisplayLoginForm'])->name('login');

Route::post('/login', [AuthenticationController::class, 'login']);

//unauthorized
Route::get('/unauthorized', function () {
    return view('errors.unauthorized'); // Show an unauthorized view or message
})->name('unauthorized');


require __DIR__.'/auth.php';
