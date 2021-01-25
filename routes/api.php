<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    //localhost:8000/api/auth/register
    Route::post('register', [UserController::class, 'signUp']); //Registro usuarios.
    //localhost:8000/api/auth/login
    Route::post('login', [UserController::class, 'login']);   //Login usuarios.
    Route::post('rent/create', [RentController::class, 'store']); //Crea reserva.
    Route::get('rent/show/{id}', [RentController::class, 'index']);
    Route::delete('rent/cancel/{id}', [RentController::class, 'destroy']); //Cancela reserva.

    Route::group(['middleware' => ['auth:api']], function () {
        //localhost:8000/api/auth/user
        Route::get('/user', function (Request $request) {
            return $request->user();//Obtiene un usuario introduciendo el token en el header.
        });
        //localhost:8000/api/auth/logout
        Route::get('logout', [UserController::class, 'logout']); //Logout.
        // Route::apiResource('users', UserController::class);
    });
});
