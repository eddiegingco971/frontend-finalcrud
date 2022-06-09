<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightBookingController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken($request->device_name)->plainTextToken;
});

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();

    return 'Tokens are deleted';
});

Route::get('/reservations', [ReservationController::class,'index']);
Route::get('/reservations/{reservation}', [ReservationController::class, 'show']);

Route::post('/reservations', [ReservationController::class,'store']);
Route::put('/reservations/{reservation}', [ReservationController::class, 'update']);

Route::delete('/reservations/{reservation}',[ReservationController::class, 'destroy']);

//User Route

Route::get('/users', [UserController::class,'index']);
Route::get('/users/{user}', [UserController::class, 'show']);

Route::post('/users', [UserController::class,'store']);
Route::put('/users/{user}', [UserController::class, 'update']);

Route::delete('/users/{user}',[UserController::class, 'destroy']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

//Booking Flight Route

Route::get('/flightBookings', [FlightBookingController::class,'index']);
Route::get('/flightBookings/{flightBooking}', [FlightBookingController::class, 'show']);

Route::post('/flightBookings', [FlightBookingController::class,'store']);
Route::put('/flightBookings/{flightBooking}', [FlightBookingController::class, 'update']);

Route::delete('/flightBookings/{flightBooking}',[FlightBookingController::class, 'destroy']);
