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
], function () {
    Route::post('register', [UserController::class, 'signUp']); //Registro usuarios:localhost:8000/api/register
    Route::post('login', [UserController::class, 'login']);   //Login usuarios:localhost:8000/api/login
    Route::post('rent', [RentController::class, 'store']); //Crea reserva:localhost:8000/api/rest
    Route::get('rent/show/{id}', [RentController::class, 'index']); //Muestra citas de un usuario
    Route::get('user/email/{email}', [UserController::class, 'getUserByEmail']); //Obtiene email usuario.
    Route::delete('rent/cancel/{id}', [RentController::class, 'destroy']); //Cancela reserva.

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        }); //localhost:8000/api/user     
        Route::get('logout', [UserController::class, 'logout']); //Logout.
    }); //localhost:8000/api/logout
});
// Route::post('/user', [AuthController::class, 'signUp']);
