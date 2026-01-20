<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['throttle:3,1'])->post('login', [AuthController::class, 'login']);

Route::get('logout', [AuthController::class, 'logout'])->middleware('api');

Route::middleware(['throttle:3,1'])->post('register',[AuthController::class,'register']);

Route::get('view-details',[AuthController::class,'viewDetails']);

Route::middleware('throttle:3,1')->group(function () {
    Route::get('users-list', [AuthController::class,'getAllUsers']);
});
