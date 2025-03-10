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
            Route::group(['prefix' => 'typeofdish'], function () {
                /*Manager Type Of Dish*/
                Route::get('/', [ManagerController::class, 'getTypeOfDish'])->name('manager.typeOfDish');
                Route::post('addTypeOfDish', [ManagerController::class, 'addTypeOfDish'])->name('manager.addTypeOfDish');
                Route::put('updateTypeOfDish/{id}', [ManagerController::class, 'updateTypeOfDish'])->name('manager.updateTypeOfDish');
                Route::get('deleteTypeOfDish/{id}', [ManagerController::class, 'deleteTypeOfDish'])->name('manager.deleteTypeOfDish');
            });
            Route::group(['prefix' => 'dish'], function () {
                /*Manager Dish*/
                Route::get('/', [ManagerController::class, 'getDish'])->name('manager.dish');
                Route::post('addDish', [ManagerController::class, 'addDish'])->name('manager.addDish');
                Route::put('updateDish/{id}', [ManagerController::class, 'updateDish'])->name('manager.updateDish');
                Route::get('deleteDish/{id}', [ManagerController::class, 'deleteDish'])->name('manager.deleteDish');
            });
            Route::group(['prefix' => 'ticket'], function () {
                /*Manager Tickets*/
                Route::get('/', [ManagerController::class, 'getTicket'])->name('manager.ticket');
                Route::post('addTicket', [ManagerController::class, 'addTicket'])->name('manager.addTicket');
                Route::put('updateTicket/{id}', [ManagerController::class, 'updateTicket'])->name('manager.updateTicket');
                Route::get('deleteTicket/{id}', [ManagerController::class, 'deleteTicket'])->name('manager.deleteTicket');
            });
            Route::group(['prefix' => 'table'], function () {
                /*Manager Table*/
                Route::get('/', [ManagerController::class, 'getTable'])->name('manager.table');
                Route::post('addTable', [ManagerController::class, 'addTable'])->name('manager.addTable');
                Route::put('updateTable/{id}', [ManagerController::class, 'updateTable'])->name('manager.updateTable');
                Route::get('deleteTable/{id}', [ManagerController::class, 'deleteTable'])->name('manager.deleteTable');
            });
        });
        /*Staffs*/
        Route::group(['prefix' => 'staff'], function () {
            Route::get('index', [StaffController::class, 'index'])->name('staff.index');
            Route::get('selectTable/{id}', [StaffController::class, 'selectTable'])->name('staff.selectTable');
            Route::post('selectTable/selectTicketPrice/{id}', [StaffController::class, 'selectTicketPrice'])->name('staff.selectTable.selectTicketPrice');
        });
    });
});
