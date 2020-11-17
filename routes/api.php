<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Company\DeleteCompanyController;
use App\Http\Controllers\Company\RegistCompanyController;
use App\Http\Controllers\Company\SearchCompanyController;
use App\Http\Controllers\Company\ShowCompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ShowUserController;
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
    Route::middleware('auth:sanctum')->get('/user', ShowUserController::class);
});

Route::prefix('company')->group(function () {
    Route::post('/', RegistCompanyController::class);
    Route::get('/show/{id}', ShowCompanyController::class);
    Route::post('/delete/{id}', DeleteCompanyController::class);
    Route::get('/search', SearchCompanyController::class);
});

Route::get('/home', HomeController::class);


