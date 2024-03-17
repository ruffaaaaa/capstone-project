<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FacilitiesController;
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
Route::get('/', [FacilitiesController::class, 'CarouselFacilities']);



Route::middleware(['auth'])->group(function () {

    Route::get('admin-dashboard', [AuthenticationController::class, 'index1'])->name('index1');
    Route::post('', [AuthenticationController::class, 'login']);
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');


});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin-facilities', function () {
        $facilities = Facilities::all();
        return view('dashboard.admin.facilities', compact('facilities'));
    })->name('admin.facilities');
    Route::post('/facilities/save', [FacilitiesController::class, 'create'])->name('facility.save');
    Route::put('/facilities/{facilityID}', [FacilitiesController::class, 'update'])->name('facilities.update');
    Route::delete('/facilities/{facilityID}', [FacilitiesController::class, 'destroy'])->name('facilities.destroy');
});

Route::get('/login', [AuthenticationController::class, 'DisplayLoginForm'])->name('login');

Route::post('/login', [AuthenticationController::class, 'login']);

require __DIR__.'/auth.php';
