<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProductController;
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
    return view('index');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return view('index');
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

######################## client ########################
Route::middleware(['auth','role:client'])->group(function(){
    Route::get('/client/dashboard',[AccountController::class,'clientDashboard'])->name('client.dashboard');
    Route::get('/client/profile',[AccountController::class,'clientProfile'])->name('client.profile');
    Route::post('/client/profile/update',[AccountController::class,'clientProfileUpdate'])->name('client.profile.update');
    Route::post('/client/update/password',[AccountController::class,'clientUpdatePassword'])->name('client.update.password');
    Route::get('/client/change/password',[AccountController::class,'clientChangePassword'])->name('client.change.password');

});
######################## SUPER ADMIN ########################
Route::prefix('s')->name('super_admin.')->middleware(['auth','verified','role:super_admin'])->group(function(){
    Route::get('/dashboard',[AccountController::class,'super_adminDashboard'])->name('dashboard');
    Route::get('/profile',[AccountController::class,'super_adminProfile'])->name('profile');
    Route::post('/profile/update',[AccountController::class,'super_adminProfileUpdate'])->name('profile.update');
    Route::post('/update/password',[AccountController::class,'super_adminUpdatePassword'])->name('update.password');
    Route::get('/change/password',[AccountController::class,'super_adminChangePassword'])->name('change.password');

    Route::resource('/users', UserController::class);
});



######################
Route::get('products', [ProductController::class,'index'])->name('products.index');
Route::get('products/create-step-one', [ProductController::class,'createStepOne'])->name('products.create.step.one');
Route::post('products/create-step-one', [ProductController::class,'postCreateStepOne'])->name('products.create.step.one.post');
Route::get('products/create-step-two', [ProductController::class,'createStepTwo'])->name('products.create.step.two');
Route::post('products/create-step-two', [ProductController::class,'postCreateStepTwo'])->name('products.create.step.two.post');
Route::get('products/create-step-three', [ProductController::class,'createStepThree'])->name('products.create.step.three');
Route::post('products/create-step-three', [ProductController::class,'postCreateStepThree'])->name('products.create.step.three.post');