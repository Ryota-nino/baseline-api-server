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
use App\Http\Controllers\Draft\RegistDraftController;
use App\Http\Controllers\Entry\DeleteEntryController;
use App\Http\Controllers\Entry\RegistEntryController;
use App\Http\Controllers\Entry\ShowEntryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyActivity\EditMyActivity;
use App\Http\Controllers\MyActivity\RegisterMyActivity;
use App\Http\Controllers\MyActivity\ShowMyActivity;
use App\Http\Controllers\OccupationalCategory\IndexOccupationalCategoryController;
use App\Http\Controllers\Selection\EditSelectionController;
use App\Http\Controllers\Selection\RegistSelectionController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\EditUserProfileController;
use App\Http\Controllers\User\MyPageController;
use App\Http\Controllers\User\RegistUserController;
use App\Http\Controllers\User\SearchUserController;
use App\Http\Controllers\User\ShowUserController;
use App\Http\Controllers\User\TemporaryRegistationUserController;
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
    Route::post('/', TemporaryRegistationUserController::class);
    Route::post('/delete/{id}', DeleteUserController::class);
    Route::post('/register', RegistUserController::class);
    Route::get('/search', SearchUserController::class);
    Route::post('/edit/{id}', EditUserProfileController::class);
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
    Route::post('/delete/{id}', DeleteEntryController::class);
    Route::get('/show/{id}', ShowEntryController::class);
});

Route::prefix('occupational_category')->group(function () {
    Route::get('/', IndexOccupationalCategoryController::class);
});

Route::prefix('selection')->group(function () {
    Route::post('/', RegistSelectionController::class);
    Route::post('/edit/{id}', EditSelectionController::class);
});

Route::prefix('my_activity')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/', RegisterMyActivity::class);
        Route::get('/show/{id}', ShowMyActivity::class);
        Route::post('/edit/{id}', EditMyActivity::class);
    });
