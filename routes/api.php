<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Company\RegistCompanyController;
use App\Http\Controllers\Draft\DeleteDraftController;
use Illuminate\Http\Request;
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

/*
|--------------------------------------------------------------------------
| 認証ルート(Auth)
|--------------------------------------------------------------------------
|
|
|
*/
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']); // ログイン
    Route::post('/logout', [AuthController::class, 'logout']); // ログアウト
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::prefix('company')->group(function () {
    Route::post('/', RegistCompanyController::class);
});

Route::prefix('draft')->group(function () {
    Route::post('/delete/{id}', DeleteDraftController::class);
});