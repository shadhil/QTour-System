<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ParkController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/sign-in', [AuthController::class, 'signInView'])->name('sign-view');
Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign-in');
Route::get('/sign-out', [AuthController::class, 'signOut'])->name('sign-out');

Route::get('/test', function () {

    //echo auth()->user()->email;
    //$user = Auth::user()->hasRole('developer'); //User::where('email', Auth::user()->id);
    //dd(auth()->user()->hasRole('developer')); //will return true, if user has role
    //dd(auth()->user()->givePermissionsTo('create-tasks')); // will return permission, if not null
    //dd(auth()->user()->can('create-tasks')); // will return true, if user has permission
    //return view('reservations.new');
})->name('null');

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'signInView'])->name('signIn');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'load_users'])->name('users');
    Route::post('/users/filter', [UserController::class, 'filter_users']);
    Route::post('/users/navigate', [UserController::class, 'navigate_users']);
    Route::get('/users/add-user', [UserController::class, 'newUser'])->name('users.new');
    Route::post('/users/save-user', [UserController::class, 'addUser'])->name('users.save');
    Route::get('/users/edit/{userId}', [UserController::class, 'editUser'])->name('users.edit');
    Route::get('/users/profile/{userId}', [UserController::class, 'userProfile'])->name('users.profile');
    Route::get('/users/delete/{userId}', [UserController::class, 'deleteUser']);

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
    Route::get('/reservations/new', [ReservationController::class, 'new'])->name('reservations.new');
    Route::post('/reservations/add-visitor', [ReservationController::class, 'addVisitor']);
    Route::get('/reservations/edit-visitor/{visitorId}', [ReservationController::class, 'editVisitor']);
    Route::post('/reservations/delete-visitor', [ReservationController::class, 'deleteVisitor']);
    Route::get('/reservations/edit/{code}', [ReservationController::class, 'editReservation'])->name('reservations.edit');
    Route::post('/reservations/filter-visitor', [ReservationController::class, 'filterVisitor']);
    Route::post('/reservations/add-reservation', [ReservationController::class, 'addReservation'])->name('reservations.add');
    Route::post('/reservations/add-group', [ReservationController::class, 'addGroup']);
    Route::get('/reservations/edit-group/{groupId}', [ReservationController::class, 'editGroup']);
    Route::post('/reservations/delete-group', [ReservationController::class, 'deleteGroup']);

    Route::get('/reservations/activities/{code}', [ActivityController::class, 'activities'])->name('reservations.activities');
    Route::get('/reservations/load-park-activities/{parkId}', [ActivityController::class, 'loadParkActivities']);
    Route::post('/reservations/add-activity', [ActivityController::class, 'addActivity']);
    Route::post('/reservations/load-activity-info', [ActivityController::class, 'loadActivityInfo']);
    Route::post('/reservations/delete-activity', [ActivityController::class, 'deleteActivity']);

    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels');
    Route::post('/hotels/filter', [HotelController::class, 'filterHotels']);
    Route::post('/hotels/navigate', [HotelController::class, 'navigateHotels']);
    Route::post('/hotels/new', [HotelController::class, 'newHotel'])->name('hotels.new');
    Route::get('/hotels/edit/{hotelId}', [HotelController::class, 'editHotel'])->name('hotels.edit');
    Route::get('/hotels/{hotel}/profile', [HotelController::class, 'hotelProfile'])->name('hotels.profile');

    Route::get('/drivers-crew', [CrewController::class, 'index'])->name('drivers-crew');
    Route::post('/drivers-crew/filter', [CrewController::class, 'filter_users']);
    Route::post('/drivers-crew/navigate', [CrewController::class, 'navigate_users']);
    Route::post('/drivers-crew/new', [CrewController::class, 'newMember'])->name('drivers-crew.new');
    Route::get('/drivers-crew/edit/{memberId}', [CrewController::class, 'editMember'])->name('drivers-crew.edit');
    Route::get('/drivers-crew/delete/{memberId}', [CrewController::class, 'deleteMember']);

    Route::get('/parks', [ParkController::class, 'index'])->name('parks');
    Route::post('/parks/filter', [ParkController::class, 'filterParks']);
    Route::post('/parks/new', [ParkController::class, 'newPark'])->name('parks.new');
    Route::get('/parks/delete/{parkId}', [ParkController::class, 'deletePark']);
    Route::get('/parks/load-park-activities/{parkId}', [ParkController::class, 'loadParkActivities']);
    Route::get('/parks/load-all-activities', [ParkController::class, 'loadAllActivities']);
    Route::post('/parks/add-park-activity', [ParkController::class, 'addParkActivity']);


    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    //Route::resource('/users', UserController::class);
    Route::get('/test', function () {
        return view('reservations.new');
    })->name('null');
});


Route::get('/login', function () {
    return view('login.main');
})->name('login');

// Route::middleware('loggedin')->group(function () {
//     Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
//     Route::post('login', [AuthController::class, 'login'])->name('login');
//     Route::get('register', [AuthController::class, 'registerView'])->name('register-view');
//     Route::post('register', [AuthController::class, 'register'])->name('register');
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/', [PageController::class, 'loadPage'])->name('dashboard');
//     Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//     Route::get('page/{layout}/{theme}/{pageName}', [PageController::class, 'loadPage'])->name('page');
// });
