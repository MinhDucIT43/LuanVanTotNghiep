<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RepassController;
use App\Http\Controllers\StaffController;

/*Login - Logout*/

Route::get('/', [AuthController::class, 'getLogin'])->name('auth.getLogin');
Route::post('login', [AuthController::class, 'postLogin'])->name('auth.postLogin');
/*-------*/
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

/*Change Password*/
Route::get('inputPhoneNumberAndReceiveCode', [RepassController::class, 'inputPhoneNumberAndReceiveCode'])->name('repass.inputPhoneNumberAndReceiveCode');
Route::post('verify', [RepassController::class, 'verify'])->name('repass.verify');
Route::group(['middleware' => 'CheckPhoneToEnterCodeForChangePassword'], function () {
    Route::get('changePassword', [RepassController::class, 'getChangePass'])->name('repass.getChangePass');
    Route::post('changePassword', [RepassController::class, 'postChangePass'])->name('repass.postChangePass');
});

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::group(['middleware' => 'CheckLogin'], function () {
        Route::group(['prefix' => 'manager'], function () {
            /*Manager*/
            Route::get('/', [ManagerController::class, 'index'])->name('manager.index');
            Route::group(['prefix' => 'position'], function () {
                /*Manager Positions*/
                Route::get('/', [ManagerController::class, 'getPosition'])->name('manager.position');
                Route::post('addPosition', [ManagerController::class, 'addPosition'])->name('manager.addPosition');
                Route::put('updatePosition/{position_code}', [ManagerController::class, 'updatePosition'])->name('manager.updatePosition');
                Route::get('deletePosition/{position_code}', [ManagerController::class, 'deletePosition'])->name('manager.deletePosition');
            });
            Route::group(['prefix' => 'staff'], function () {
                /*Manager Staffs*/
                Route::get('/', [ManagerController::class, 'getStaff'])->name('manager.staff');
                Route::post('addStaff', [ManagerController::class, 'addStaff'])->name('manager.addStaff');
                Route::put('updateStaff/{staff_code}', [ManagerController::class, 'updateStaff'])->name('manager.updateStaff');
                Route::get('deleteStaff/{staff_code}', [ManagerController::class, 'deleteStaff'])->name('manager.deleteStaff');
            });
        });
        /*Staffs*/
        Route::get('staff/index', [StaffController::class, 'index'])->name('staff.index');
    });
});
