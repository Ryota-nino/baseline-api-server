<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Company\DeleteCompanyController;
use App\Http\Controllers\Company\DetailCompanyController;
use App\Http\Controllers\Company\EditCompanyController;
use App\Http\Controllers\Company\RegistCompanyController;
use App\Http\Controllers\Company\SearchCompanyController;
use App\Http\Controllers\Company\ShowCompanyController;
use App\Http\Controllers\Draft\DeleteDraftController;
use App\Http\Controllers\Draft\IndexDraftController;
use App\Http\Controllers\Entry\RegistEntryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OccupationalCategory\IndexOccupationalCategoryController;
use App\Http\Controllers\User\MyPageController;
use App\Http\Controllers\User\SearchUserController;
use App\Http\Controllers\User\ShowUserController;
use App\Http\Controllers\Draft\RegistDraftController;
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
    Route::middleware('auth:sanctum')->get('/user', ShowUserController::class);
});

Route::get('/home', HomeController::class);
Route::get('/mypage', MyPageController::class);
Route::get('/mypage/{id}', MyPageController::class);

Route::prefix('user')->group(function () {
    Route::get('/search', SearchUserController::class);
});

Route::prefix('company')->group(function () {
    Route::post('/', RegistCompanyController::class);
    Route::get('/show/{id}', ShowCompanyController::class);
    Route::post('/delete/{id}', DeleteCompanyController::class);
    Route::get('/search', SearchCompanyController::class);
    Route::post('/edit/{id}', EditCompanyController::class);
    Route::get('/detail/{id}', DetailCompanyController::class);
});

Route::prefix('draft')->group(function () {
    Route::get('/', IndexDraftController::class);
    Route::post('/', RegistDraftController::class);
    Route::post('/delete/{id}', DeleteDraftController::class);
});

Route::prefix('entry')->group(function () {
    Route::middleware('auth:sanctum')->post('/', RegistEntryController::class);
});

Route::prefix('occupational_category')->group(function () {
    Route::get('/', IndexOccupationalCategoryController::class);
});
