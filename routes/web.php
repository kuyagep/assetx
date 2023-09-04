<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

######################## ADMIN ########################
Route::prefix('admin')->name('admin.')->middleware(['auth','verified','role:admin'])->group(function(){
    Route::get('/dashboard',[AccountController::class,'AdminDashboard'])->name('dashboard');
    Route::get('/profile',[AccountController::class,'AdminProfile'])->name('profile');
    Route::post('/profile/update',[AccountController::class,'AdminProfileUpdate'])->name('profile.update');
    Route::post('/update/password',[AccountController::class,'AdminUpdatePassword'])->name('update.password');
    Route::get('/change/password',[AccountController::class,'AdminChangePassword'])->name('change.password');

    Route::resource('/users', UserController::class);
});

######################## CLIENT ########################
Route::middleware(['auth','role:client'])->group(function(){
    Route::get('/client/dashboard',[AccountController::class,'ClientDashboard'])->name('client.dashboard');
    Route::get('/client/profile',[AccountController::class,'ClientProfile'])->name('client.profile');
    Route::post('/client/profile/update',[AccountController::class,'ClientProfileUpdate'])->name('client.profile.update');
    Route::post('/client/update/password',[AccountController::class,'ClientUpdatePassword'])->name('client.update.password');
    Route::get('/client/change/password',[AccountController::class,'ClientChangePassword'])->name('client.change.password');

});
######################## SUPER ADMIN ########################
Route::middleware(['auth','role:super_admin'])->group(function(){
    Route::get('/s/dashboard',[AccountController::class,'SuperAdminDashboard'])->name('s.dashboard');
    Route::get('/s/profile',[AccountController::class,'SuperAdminProfile'])->name('s.profile');
    Route::post('/s/profile/update',[AccountController::class,'SuperAdminProfileUpdate'])->name('s.profile.update');
    Route::post('/s/update/password',[AccountController::class,'SuperAdminUpdatePassword'])->name('s.update.password');
    Route::get('/s/change/password',[AccountController::class,'SuperAdminChangePassword'])->name('s.change.password');

});