<?php

use App\Http\Controllers\AccountController;
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
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AccountController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile',[AccountController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update',[AccountController::class,'AdminProfileUpdate'])->name('admin.profile.update');
    Route::post('/admin/update/password',[AccountController::class,'AdminUpdatePassword'])->name('admin.update.password');
    Route::get('/admin/change/password',[AccountController::class,'AdminChangePassword'])->name('admin.change.password');

});

######################## CLIENT ########################
Route::middleware(['auth','role:client'])->group(function(){
    Route::get('/client/dashboard',[AccountController::class,'ClientDashboard'])->name('client.dashboard');
    Route::get('/client/profile',[AccountController::class,'ClientProfile'])->name('client.profile');
    Route::post('/client/profile/update',[AccountController::class,'ClientProfileUpdate'])->name('client.profile.update');
    Route::post('/client/update/password',[AccountController::class,'ClientUpdatePassword'])->name('client.update.password');
    Route::get('/client/change/password',[AccountController::class,'ClientChangePassword'])->name('client.change.password');

});