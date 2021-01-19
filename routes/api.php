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

Route::get('/', function () {
    return response()->json(['message' => 'servidor corriendo'], 200);
});

Route::post('user/register', [UserController::class, 'signUp']); //Registro usuarios.
Route::post('user/login', [UserController::class, 'login']);   //Login usuarios.

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('users', UserController::class);

    Route::post('client/logout', [UserController::class, 'logout']); //Logout.

    Route::post('rent/create', [RentController::class, 'store']); //Crea reserva.
    Route::get('rent/show', [RentController::class, 'index']);
    Route::delete('rent/cancel/{id}', [RentController::class, 'destroy']); //Cancela reserva.

    // Route::group(['middleware' => ['rol:admin']], function () {
    //     Route::get('/rent/showAll', [RentController::class, 'indexAll']); //Muestra reservas. 
    // });
});
