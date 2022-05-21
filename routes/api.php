<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/reservations', [ReservationController::class,'index']);
Route::get('/reservations/{reservation}', [ReservationController::class, 'show']);

Route::post('/reservations', [ReservationController::class,'store']);
Route::put('/reservations/{reservation}', [ReservationController::class, 'update']);

Route::delete('/reservations/{reservation}',[ReservationController::class, 'destroy']);