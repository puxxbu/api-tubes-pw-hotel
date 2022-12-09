<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\api\EmailVerificationController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PesananMakananController;
use App\Models\Kamar;
use App\Models\PesananMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/login', function () {
//     return "selamat datang di login";
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Auth::routes(['verify' => true]);

// Route::get('/email/verify/need-verification', [VerificationController::class, 'notice'])->middleware('auth:sanctum')->name('verification.notice');
Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum')->name('verification.notice');


Route::middleware(['auth:sanctum', 'verified'])->get('/user', function (Request $request) {
    return $request->user();
});

//route pesanan
Route::apiResource('pesanan-makanan', PesananMakananController::class);
//route kamar
Route::apiResource('kamar', KamarController::class);