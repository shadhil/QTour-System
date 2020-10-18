<?php

use App\Http\Controllers\DashboardController;
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


Route::get('/sign-in', [UserController::class, 'signingView'])->name('sign-view');
Route::post('/sign-in', [UserController::class, 'signIn'])->name('sign-in');
Route::get('/sign-out', [UserController::class, 'signOut'])->name('sign-out');

Route::get('/', function () {

    //echo auth()->user()->email;
    //$user = Auth::user()->hasRole('developer'); //User::where('email', Auth::user()->id);
    //dd(auth()->user()->hasRole('developer')); //will return true, if user has role
    //dd(auth()->user()->givePermissionsTo('create-tasks')); // will return permission, if not null
    //dd(auth()->user()->can('create-tasks')); // will return true, if user has permission
    //return view('reservations.new');
})->name('null');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', UserController::class);
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
