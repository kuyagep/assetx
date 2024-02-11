<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BackEnd\PurchaseOrderController;
use App\Http\Controllers\BackEnd\SuppliersController;
use App\Http\Controllers\MaintenanceController;
use Illuminate\Support\Facades\Route;
############################### ACCOUNT 
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountableController;
############################### AUTH 
use App\Http\Controllers\AuthController;
############################### LANDING PAGE 
use App\Http\Controllers\FrontEnd\HomeController;
############################### DASHBOARD
use App\Http\Controllers\BackEnd\AssetClassificationController;
use App\Http\Controllers\BackEnd\AssetStatusController;
use App\Http\Controllers\BackEnd\AssetController;
use App\Http\Controllers\BackEnd\IssuanceController;
use App\Http\Controllers\BackEnd\IssuanceTypeController;
use App\Http\Controllers\BackEnd\OfficeController;
use App\Http\Controllers\BackEnd\PermissionGroupController;
use App\Http\Controllers\BackEnd\PositionController;
use App\Http\Controllers\BackEnd\PurchaseController;
use App\Http\Controllers\BackEnd\RoleController;
use App\Http\Controllers\BackEnd\SchoolController;
use App\Http\Controllers\BackEnd\UsersController;
use App\Http\Controllers\BackEnd\AdminController;
use App\Http\Controllers\BackEnd\AssetIssuanceController;
use App\Http\Controllers\BackEnd\DistrictController;
use App\Http\Controllers\BackEnd\DivisionController;

############################### FOR UPDATE
use App\Http\Controllers\ProductController;


// External
Route::get('/auth', [AuthController::class, 'store'])->name('auth');
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');

require __DIR__ . '/auth.php';


Route::get('/test/application', function () {
    return view('testing.application');
});

Route::get('/pdf', function () {
    return view('testing.pdf');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::get('application',[ ApplicationController::class, 'index'])->name('application.index');



######################## SUPER ADMIN ########################
Route::prefix('my')->middleware(['auth', 'role:super-admin|admin'])->group(function () {

    
    
    //* ############# SUPER ADMIN #############
    Route::controller(AccountController::class)->middleware(['role:super-admin'])->group(function () {
        Route::get('/dashboard', 'super_adminDashboard')->name('dashboard');
        Route::get('/profile', 'super_adminProfile')->name('profile');
        Route::post('/profile/update', 'super_adminProfileUpdate')->name('profile.update');
        Route::post('/update/password', 'super_adminUpdatePassword')->name('update.password');
        Route::post('/security/check-current-password', 'super_adminCheckPassword')->name('check.password');
    });

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
    Route::resource('/classifications', AssetClassificationController::class);
    #asset status
    Route::resource('/asset-status', AssetStatusController::class);
    #asset issuance type
    Route::resource('/issuance-type', IssuanceTypeController::class);
    #assets
    Route::resource('/assets', AssetController::class);
    Route::controller(AssetController::class)->group(function () {
       
        Route::get('/assets/non/expendable', 'nonExpendable')->name('assets.non-expendable');
        
    });
    #issuances

    Route::resource('/issuances', IssuanceController::class);
    Route::controller(IssuanceController::class)->group(function () {
        Route::get('/get-assets-by-classification/{classificationId}', 'getAssetsByClassification')->name('get.assets');
        Route::get('/get-school-or-office', 'getSchoolOrOffice')->name('get.school.office');
        Route::get('/get-issued-to', 'getIssuedTo')->name('get.issued.to');
        
    });
    Route::controller(AssetIssuanceController::class)->group(function () {
        Route::get('/asset-issuance/', 'create')->name('asset_issuance.create');
        Route::post('/asset-issuance/', 'store')->name('asset_issuance.store');
        Route::post('/asset-issuance/{id}', 'destroy')->name('asset_issuance.destroy');
        Route::get('/asset/issuance/', 'getAssetByClassification')->name('get.asset');
        Route::get('/asset/issuance/generate/{id}', 'generateIssuances')->name('asset_issuance.generate');

    });
    #issuances
    Route::resource('/purchase', PurchaseController::class);
    Route::get('/download/attachment/{id}', [PurchaseController::class, 'download'])->name('purchase.download');
    Route::get('/purchase/history/{purchase}', [PurchaseController::class, 'history'])->name('purchase.history');

    Route::get('/purchase/exports/', [PurchaseController::class, 'exportPurchase'])->name('export.purchase.request');

    Route::name('super_admin.')->controller(PurchaseController::class)->group(function () {
        Route::put('/purchase/{purchase}', 'approved')->name('purchase.approved');
        // Route::get('/purchase/exports/','exportPurchase')->name('export.purchase.request');
    });

    #accountability
    Route::resource('/accountability', AccountableController::class);
    #permission group
    Route::resource('/permission-group', PermissionGroupController::class);
    //* permission
    Route::get('/permission', [RoleController::class, 'allPermission'])->name('all.permission');
    Route::post('/permission', [RoleController::class, 'storePermission'])->name('permission.add');
    Route::get('/permission/{id}/edit', [RoleController::class, 'editPermission'])->name('permission.edit');
    Route::delete('/permission/{id}', [RoleController::class, 'destroyPermission'])->name('permission.destroy');
    Route::get('/permission/import', [RoleController::class, 'importPermission'])->name('import.permission');
    Route::get('/permission/export/', [RoleController::class, 'exportPermission'])->name('export.permission');
    Route::post('/permission/import/', [RoleController::class, 'importPermissions'])->name('import.permissions');

    //* roles
    Route::get('/roles', [RoleController::class, 'allRoles'])->name('all.roles');
    Route::post('/roles', [RoleController::class, 'storeRoles'])->name('roles.add');
    Route::get('/roles/{id}/edit', [RoleController::class, 'editRoles'])->name('roles.edit');
    Route::delete('/roles/{id}', [RoleController::class, 'destroyRoles'])->name('roles.destroy');

    //* roles in permission
    Route::get('/roles/permission/', [RoleController::class, 'addRolePermission'])->name('add.roles.permission');
    Route::post('/roles/permission/', [RoleController::class, 'storeRolesPermission'])->name('roles.permission.store');
    Route::get('/roles/permission/all', [RoleController::class, 'allRolesPermission'])->name('all.roles.permission');
    Route::get('/roles/permission/{id}/edit', [RoleController::class, 'editRolesPermission'])->name('roles.permission.edit');
    Route::post('/roles/permission/{id}', [RoleController::class, 'updateRolesPermission'])->name('roles.permission.update');
    Route::delete('/roles/permission/{id}', [RoleController::class, 'destroyRolesPermission'])->name('roles.permission.destroy');

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

        Route::get('/online/users', 'online')->name('user.online');
    });


    
    ##### ADMIN PART #####

    //* ############# ADMIN #############
    Route::controller(AccountController::class)->prefix('account')->as('account.')->middleware(['role:admin'])->group(function () {
        //* ->middleware('permission:division.all')
        Route::get('/dashboard', 'adminDashboard')->name('dashboard');
        Route::get('/profile', 'adminProfile')->name('profile');
        Route::post('/profile/update', 'adminProfileUpdate')->name('profile.update');
        Route::post('/update/password', 'adminUpdatePassword')->name('update.password');
    });


    Route::controller(PurchaseOrderController::class)->group(function () {
        Route::get('/purchase-order', 'adminPurchaseOrder')->name('purchase.order');
        Route::post('/purchase-order', 'store')->name('purchase.order.store');
        Route::get('/purchase-order/show/{id}', 'show')->name('purchase.order.show');
        Route::get('/purchase-order/{id}/edit', 'edit')->name('purchase.order.edit');
        Route::get('/purchase-order/export/','exportPurchaseOrder')->name('export.purchase.order');
        Route::put('/purchase-order/{purchase-order}', 'approved')->name('purchase.order.approved');
        Route::get('/purchase-order/history/{purchase-order}',  'history')->name('purchase.order.history');
        Route::get('/purchase/request/', 'getPurchaseRequest')->name('get.purchase.request');
    });

    Route::controller(SuppliersController::class)->group(function () {
        Route::get('/suppliers', 'index')->name('suppliers.index');
        Route::post('/suppliers', 'store')->name('suppliers.store');
        Route::get('/supplier/{id}/edit', 'edit')->name('suppliers.edit');
        Route::get('/supplier/show/{id}', 'show')->name('suppliers.show');
        Route::post('/supplier/update/{id}', 'update')->name('suppliers.update');
        Route::delete('/suppliers/destroy/{id}', 'destroy')->name('suppliers.destroy');
    });
});








//* ############# CLIENT ROUTE #############
Route::prefix('client')->as('client.')->middleware(['auth', 'role:client'])->group(function () {

    Route::controller(AccountController::class)->group(function () {
        Route::get('/dashboard', 'clientsDashboard')->name('dashboard');
        Route::get('/profile', 'clientsProfile')->name('profile');
        Route::post('/profile/update', 'clientsProfileUpdate')->name('profile.update');
        Route::post('/update/password', 'clientsUpdatePassword')->name('update.password');
    });
    
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase', 'clientPurchase')->name('purchase');
        Route::post('/purchase', 'store')->name('purchase.store');
        Route::get('/purchase/show/{id}', 'show')->name('purchase.show');
        Route::get('/purchase/{id}/edit', 'edit')->name('purchase.edit');
        Route::get('/purchase/export/','exportPurchase')->name('export.purchase');
        Route::put('/purchase/{purchase}', 'approved')->name('purchase.approved');
        Route::get('/download/attachment/{id}', 'download')->name('purchase.download');
        Route::get('/purchase/history/{purchase}',  'history')->name('purchase.history');
    });

    Route::controller(PurchaseOrderController::class)->group(function () {
        Route::get('/purchase-order', 'clientPurchaseOrder')->name('purchase.order');
        Route::post('/purchase-order', 'store')->name('purchase.order.store');
        Route::get('/purchase-order/show/{id}', 'show')->name('purchase.order.show');
        Route::get('/purchase-order/{id}/edit', 'edit')->name('purchase.order.edit');
        Route::get('/purchase-order/export/','exportPurchaseOrder')->name('export.purchase.order');
        Route::put('/purchase-order/{purchase-order}', 'approved')->name('purchase.order.approved');
        Route::get('/purchase-order/history/{purchase-order}',  'history')->name('purchase.order.history');
        Route::get('/purchase/request/', 'getPurchaseRequest')->name('get.purchase.request');
    });
     #assets
    Route::resource('/assets', AssetController::class);

    // Route::resource('/issuances', IssuanceController::class);
    Route::controller(IssuanceController::class)->group(function () {
        Route::GET('/issuances', 'client_index')->name('issuances.index');
        Route::post('/issuances', 'store')->name('issuances.store');
        Route::GET('/issuances/create', 'create')->name('issuances.create');
        Route::GET('/issuances/{issuance}', 'show')->name('issuances.show');
        Route::PUT('/issuances/{issuance}', 'update')->name('issuances.update');
        Route::DELETE('/issuances/{issuance}', 'destroy')->name('issuances.destroy');
        Route::GET('/issuances/{issuance}/edit', 'edit')->name('issuances.edit');
        
    });
});






###################### Example of Multi Step Form ##########################
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create-step-one', [ProductController::class, 'createStepOne'])->name('products.create.step.one');
Route::post('products/create-step-one', [ProductController::class, 'postCreateStepOne'])->name('products.create.step.one.post');
Route::get('products/create-step-two', [ProductController::class, 'createStepTwo'])->name('products.create.step.two');
Route::post('products/create-step-two', [ProductController::class, 'postCreateStepTwo'])->name('products.create.step.two.post');
Route::get('products/create-step-three', [ProductController::class, 'createStepThree'])->name('products.create.step.three');
Route::post('products/create-step-three', [ProductController::class, 'postCreateStepThree'])->name('products.create.step.three.post');