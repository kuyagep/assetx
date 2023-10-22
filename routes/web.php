<?php


use App\Http\Controllers\SuperAdmin\AssetStatusController;
use App\Http\Controllers\SuperAdmin\DistrictController;
use App\Http\Controllers\SuperAdmin\DivisionController;
use App\Http\Controllers\AccountabilityController;
use App\Http\Controllers\AccountableController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminAssetStatusController;
use App\Http\Controllers\Admin\AdminIssuanceTypeController;
use App\Http\Controllers\Admin\AdminPurchaseController;
use App\Http\Controllers\Admin\ClassificationsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AssetSearchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController as ControllersPurchaseController;
use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\AssetController;
use App\Http\Controllers\SuperAdmin\ClassificationController;
use App\Http\Controllers\SuperAdmin\IssuanceController;
use App\Http\Controllers\SuperAdmin\IssuanceTypeController;
use App\Http\Controllers\SuperAdmin\OfficeController;
use App\Http\Controllers\SuperAdmin\PermissionGroupController;
use App\Http\Controllers\SuperAdmin\PositionController;
use App\Http\Controllers\SuperAdmin\PurchaseController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\SchoolController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\UserController;
use App\Models\Office;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

######################## ADMIN ########################
Route::prefix('admin')->name('admin.')->middleware(['auth','verified','role:admin'])->group(function(){
    Route::get('/dashboard',[DashboardController::class,'AdminDashboard'])->name('dashboard');
    Route::get('/profile',[AccountController::class,'AdminProfile'])->name('profile');
    Route::post('/profile/update',[AccountController::class,'AdminProfileUpdate'])->name('profile.update');
    Route::post('/update/password',[AccountController::class,'AdminUpdatePassword'])->name('update.password');
    Route::get('/change/password',[AccountController::class,'AdminChangePassword'])->name('change.password');

    Route::resource('/users', AdminUserController::class);
    #asset classifications
    Route::resource('/classifications', ClassificationsController::class);
    #asset status
    Route::resource('/asset-status', AdminAssetStatusController::class);
    #purchases
    Route::resource('/purchase', AdminPurchaseController::class);
    #issue items
    Route::resource('/purchase', AdminPurchaseController::class);
    #asset issuance type
    Route::resource('/issuance-type', AdminIssuanceTypeController::class);
    
    Route::get('/search', [AssetSearchController::class, 'search'])->name('search');

    Route::get('/issue-items', function () {
        return view('admin.issue-items');
    });

    Route::get('/all-issuances', function () {
        return view('admin.all-issuances');
    });
    
    Route::get('/asset-registration', function () {
        return view('admin.asset-registration');
    });

    Route::get('/reports', function () {
        return view('admin.reports');
    });
    Route::get('/backups', function () {
        return view('admin.backups');
    });
    
});

######################## client ########################
Route::prefix('client')->name('client.')->middleware(['auth','verified','role:client'])->group(function(){
    Route::get('/dashboard',[AccountController::class,'clientDashboard'])->name('dashboard');
    Route::get('/profile',[AccountController::class,'clientProfile'])->name('profile');
    Route::post('/profile/update',[AccountController::class,'clientProfileUpdate'])->name('profile.update');
    Route::post('/update/password',[AccountController::class,'clientUpdatePassword'])->name('update.password');
    Route::get('/change/password',[AccountController::class,'clientChangePassword'])->name('change.password');

    Route::get('/returned-items',  [AccountableController::class, 'returned_items'])->name('returned-items');
    Route::get('/transferred-items',  [AccountableController::class, 'transferred_items'])->name('transferred-items');
    
    #issuances
    Route::resource('/purchase', ControllersPurchaseController::class);
    #accountability
    Route::resource('/accountability', AccountableController::class);
    

    Route::get('/backup', function () {
        return view('client.back-up');
    });
});

######################## SUPER ADMIN ########################
Route::prefix('s')->name('super_admin.')->middleware(['auth','roles:super_admin'])->group(function(){
    Route::get('/dashboard',[AccountController::class,'super_adminDashboard'])->name('dashboard');
    Route::get('/profile',[AccountController::class,'super_adminProfile'])->name('profile');
    Route::post('/profile/update',[AccountController::class,'super_adminProfileUpdate'])->name('profile.update');
    Route::post('/update/password',[AccountController::class,'super_adminUpdatePassword'])->name('update.password');

    Route::resource('/users', UsersController::class);

    #division
    Route::controller(DivisionController::class)->group(function () {
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
    
    
    //  Route::get('/district', [DistrictController::class,'index'])->name('district');
    //  Route::get('/district/create', [DistrictController::class,'create'])->name('district.create');
     
});



###################### Example of Multi Step Form ##########################
Route::get('products', [ProductController::class,'index'])->name('products.index');
Route::get('products/create-step-one', [ProductController::class,'createStepOne'])->name('products.create.step.one');
Route::post('products/create-step-one', [ProductController::class,'postCreateStepOne'])->name('products.create.step.one.post');
Route::get('products/create-step-two', [ProductController::class,'createStepTwo'])->name('products.create.step.two');
Route::post('products/create-step-two', [ProductController::class,'postCreateStepTwo'])->name('products.create.step.two.post');
Route::get('products/create-step-three', [ProductController::class,'createStepThree'])->name('products.create.step.three');
Route::post('products/create-step-three', [ProductController::class,'postCreateStepThree'])->name('products.create.step.three.post');