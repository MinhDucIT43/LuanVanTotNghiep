<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RepassController;
use App\Http\Controllers\StaffController;

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

/*Login - Logout*/

Route::get('/', [AuthController::class, 'getLogin'])->name('auth.getLogin');
Route::post('login', [AuthController::class, 'postLogin'])->name('auth.postLogin');
/*-------*/
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

/*Change Password*/
Route::get('resetpassword', [RepassController::class, 'getResetPassword'])->name('repass.getResetPassword');
Route::post('resetpassword', [RepassController::class, 'postResetPassword'])->name('repass.postResetPassword');
// Route::group(['middleware' => 'CheckPhoneToEnterCodeForChangePassword'], function () {
    /*-------*/
    Route::get('code', [RepassController::class, 'getCode'])->name('repass.getCode');
    Route::post('code', [RepassController::class, 'postCode'])->name('repass.postCode');
    /*-------*/
    Route::get('changepass', [RepassController::class, 'getChangePass'])->name('repass.getChangePass');
    Route::post('changepass', [RepassController::class, 'postChangePass'])->name('repass.postChangePass');
// });

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::group(['middleware' => 'CheckLogin'], function () {
        /*Manager*/
        Route::get('manager/index', [ManagerController::class, 'index'])->name('manager.index');
        /*Manager Positions*/
        Route::get('manager/position', [ManagerController::class, 'getPosition'])->name('manager.position');
        /*Manager Staffs*/
        Route::post('addstaff', [StaffController::class, 'addstaff'])->name('manager.addstaff');

        /*Staffs*/
        Route::get('staff/index', [StaffController::class, 'index'])->name('staff.index');
    });
});
