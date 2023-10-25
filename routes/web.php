<?php

use Illuminate\Support\Facades\Route;
############################### ACCOUNT 
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountableController;
############################### AUTH 
use App\Http\Controllers\AuthController;
############################### LANDING PAGE 
use App\Http\Controllers\FrontEnd\HomeController;
############################### DASHBOARD
use App\Http\Controllers\BackEnd\AdminController;
use App\Http\Controllers\BackEnd\AssetController;
use App\Http\Controllers\BackEnd\ClassificationController;
use App\Http\Controllers\BackEnd\IssuanceController;
use App\Http\Controllers\BackEnd\IssuanceTypeController;
use App\Http\Controllers\BackEnd\OfficeController;
use App\Http\Controllers\BackEnd\PermissionGroupController;
use App\Http\Controllers\BackEnd\PositionController;
use App\Http\Controllers\BackEnd\PurchaseController;
use App\Http\Controllers\BackEnd\RoleController;
use App\Http\Controllers\BackEnd\SchoolController;
use App\Http\Controllers\BackEnd\UsersController;
use App\Http\Controllers\BackEnd\AssetStatusController;
use App\Http\Controllers\BackEnd\DistrictController;
use App\Http\Controllers\BackEnd\DivisionController;
############################### FOR UPDATE
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetSearchController;
use App\Http\Controllers\PurchaseController as ControllersPurchaseController;
use App\Http\Controllers\Admin\AdminAssetStatusController;
use App\Http\Controllers\Admin\AdminIssuanceTypeController;
use App\Http\Controllers\Admin\AdminPurchaseController;
use App\Http\Controllers\Admin\ClassificationsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;



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
Route::get('/auth', [AuthController::class, 'store'])->name('auth');

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('index');
});

Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/features', [HomeController::class, 'features'])->name('features');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/disclaimer', [HomeController::class, 'disclaimer'])->name('disclaimer');
Route::get('/terms-of-service', [HomeController::class, 'termsService'])->name('terms-of-service');
Route::get('/data-privacy-notice', [HomeController::class, 'dataPrivacy'])->name('data-privacy-notice');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


######################## SUPER ADMIN ########################
Route::prefix('my')->middleware(['auth','role:super-admin|admin'])->group(function(){
    Route::get('/dashboard',[AccountController::class,'super_adminDashboard'])->name('dashboard');
    Route::get('/profile',[AccountController::class,'super_adminProfile'])->name('profile');
    Route::post('/profile/update',[AccountController::class,'super_adminProfileUpdate'])->name('profile.update');
    Route::post('/update/password',[AccountController::class,'super_adminUpdatePassword'])->name('update.password');

    #division
    //* prefix('s')->name('super_admin.')->
    Route::name('super_admin.')->controller(DivisionController::class)->group(function () {
        //* ->middleware('permission:division.all')
        Route::get('/division', 'index')->name('division.index');
        Route::post('/division', 'store')->name('division.store');
        Route::get('/division/create', 'create')->name('division.create');
        Route::get('/division/{division}', 'show')->name('division.show');
        Route::put('/division/{division}', 'update')->name('division.update');
        Route::get('/division/{division}/edit', 'edit')->name('division.edit');
        Route::delete('/division/{division}', 'destroy')->name('division.destroy');        
     });
   
    #district
    Route::resource('/districts', DistrictController::class);
    #schools
    Route::resource('/schools', SchoolController::class);
    #offices
    Route::resource('/offices', OfficeController::class);
    #positions
    Route::resource('/positions', PositionController::class);
    #asset classifications
    Route::resource('/classifications', ClassificationController::class);
    #asset status
    Route::resource('/asset-status', AssetStatusController::class);
    #asset issuance type
    Route::resource('/issuance-type', IssuanceTypeController::class);
    #assets
    Route::resource('/assets', AssetController::class);
    #issuances
    Route::resource('/issuances', IssuanceController::class);
    #issuances
    Route::resource('/purchase', PurchaseController::class);

    #accountability
    Route::resource('/accountability', AccountableController::class);
    #permission group
    Route::resource('/permission-group', PermissionGroupController::class);
    //* permission
    Route::get('/permission',[RoleController::class,'allPermission'])->name('all.permission');
    Route::post('/permission',[RoleController::class,'storePermission'])->name('permission.add');
    Route::get('/permission/{id}/edit',[RoleController::class,'editPermission'])->name('permission.edit');
    Route::delete('/permission/{id}',[RoleController::class,'destroyPermission'])->name('permission.destroy');
    Route::get('/permission/import',[RoleController::class,'importPermission'])->name('import.permission');
    Route::get('/permission/export/',[RoleController::class,'exportPermission'])->name('export.permission');
    Route::post('/permission/import/',[RoleController::class,'importPermissions'])->name('import.permissions');
    //* roles
    Route::get('/roles',[RoleController::class,'allRoles'])->name('all.roles');
    Route::post('/roles',[RoleController::class,'storeRoles'])->name('roles.add');
    Route::get('/roles/{id}/edit',[RoleController::class,'editRoles'])->name('roles.edit');
    Route::delete('/roles/{id}',[RoleController::class,'destroyRoles'])->name('roles.destroy');
    //* roles in permission
    Route::get('/roles/permission/',[RoleController::class,'addRolePermission'])->name('add.roles.permission');
    Route::post('/roles/permission/',[RoleController::class,'storeRolesPermission'])->name('roles.permission.store');
    Route::get('/roles/permission/all',[RoleController::class,'allRolesPermission'])->name('all.roles.permission');
    Route::get('/roles/permission/{id}/edit',[RoleController::class,'editRolesPermission'])->name('roles.permission.edit');
    Route::post('/roles/permission/{id}',[RoleController::class,'updateRolesPermission'])->name('roles.permission.update');
    Route::delete('/roles/permission/{id}',[RoleController::class,'destroyRolesPermission'])->name('roles.permission.destroy');

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/all', 'allAdmin')->name('all.admin');
        Route::post('/admin/store', 'storeAdmin')->name('admin.store');
        Route::get('/admin/{id}/edit', 'editAdmin')->name('admin.edit');
        Route::post('/admin/update/{id}', 'updateAdmin')->name('admin.update');
        Route::delete('/admin/destroy/{id}', 'destroyAdmin')->name('admin.destroy');
    });

    Route::controller(UsersController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::post('/user', 'store')->name('user.store');
        Route::get('/user/{id}/edit', 'edit')->name('user.edit');
        Route::post('/user/update/{id}', 'update')->name('user.update');
        Route::delete('/user/destroy/{id}', 'destroy')->name('user.destroy');
    });
         
});



###################### Example of Multi Step Form ##########################
Route::get('products', [ProductController::class,'index'])->name('products.index');
Route::get('products/create-step-one', [ProductController::class,'createStepOne'])->name('products.create.step.one');
Route::post('products/create-step-one', [ProductController::class,'postCreateStepOne'])->name('products.create.step.one.post');
Route::get('products/create-step-two', [ProductController::class,'createStepTwo'])->name('products.create.step.two');
Route::post('products/create-step-two', [ProductController::class,'postCreateStepTwo'])->name('products.create.step.two.post');
Route::get('products/create-step-three', [ProductController::class,'createStepThree'])->name('products.create.step.three');
Route::post('products/create-step-three', [ProductController::class,'postCreateStepThree'])->name('products.create.step.three.post');