<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CmspagesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'],function () {

    Route::match(['get', 'post'],'login',[AdminController::class, 'login'])->name('admin.login');

    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::match(['get','post'],'updatePassword', [AdminController::class,'updatePassword'])->name('admin.updatePassword');
        Route::match(['get','post'],'update-admin-details', [AdminController::class,'updateAdminDetails'])->name('admin.updateAdminDetails');
        Route::post('check-current-password', [AdminController::class,'checkcurrentPassword'])->name('admin.checkcurrentPassword');

        // Display CMS Pages (CRUD - Read)

        Route::get('cms-Pages',[CmspagesController::class,'index'])->name('admin.cms-Pages');
        Route::post('update-cmspage-status',[CmspagesController::class,'update'])->name('admin.update-cmspage-status');
        Route::match(['get','post'],'add-edit-cmspage/{id?}',[CmspagesController::class, 'edit'])->name('admin.add-edit-cmspage');
        Route::get('delete-cmspage/{id?}',[CmspagesController::class,'destroy'])->name('admin.delete-cmspage');

        //subadmin route
        Route::get('subAdmin',[AdminController::class,'subadmin'])->name('admin.subadmin');
        Route::post('update-subadmin-status',[AdminController::class,'updateSubAdminStatus'])->name('admin.updateSubAdminStatus');
        Route::get('delete-subadmin/{id?}',[AdminController::class,'Deletesubadmin'])->name('admin.delete-subadmin');
        Route::match(['get','post'],'add-edit-subadmin/{id?}',[AdminController::class, 'addEditSubadmin'])->name('admin.add-edit-subadmin');

        //admins Role Routers
        Route::match (['get','post'],'update-role/{id}',[AdminController::class, 'updateAdminsRoles'])->name('admin.updateAdminsRoles');

    });
});
