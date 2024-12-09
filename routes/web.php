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
Route::get('inputPhoneNumberAndReceiveCode', [RepassController::class, 'inputPhoneNumberAndReceiveCode'])->name('repass.inputPhoneNumberAndReceiveCode');
Route::post('verify', [RepassController::class, 'verify'])->name('repass.verify');
Route::group(['middleware' => 'CheckPhoneToEnterCodeForChangePassword'], function () {
    Route::get('changepass', [RepassController::class, 'getChangePass'])->name('repass.getChangePass');
    Route::post('changepass', [RepassController::class, 'postChangePass'])->name('repass.postChangePass');
});

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
