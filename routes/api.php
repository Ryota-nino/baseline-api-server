<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Company\DeleteCompanyController;
use App\Http\Controllers\Company\DetailCompanyController;
use App\Http\Controllers\Company\DetailCompanyUserController;
use App\Http\Controllers\Company\EditCompanyController;
use App\Http\Controllers\Company\RegistCompanyController;
use App\Http\Controllers\Company\SearchCompanyController;
use App\Http\Controllers\Company\ShowCompanyController;
use App\Http\Controllers\CompanyComment\EditCompanyCommentController;
use App\Http\Controllers\CompanyComment\RegistCompanyCommentController;
use App\Http\Controllers\CompanyComment\ShowCompanyCommentController;
use App\Http\Controllers\CompanyInformation\DeleteCompanyInformation;
use App\Http\Controllers\Draft\DeleteDraftController;
use App\Http\Controllers\Draft\IndexDraftController;
use App\Http\Controllers\Draft\RegistDraftController;
use App\Http\Controllers\EmploymentStatus\EditEmploymentStatusController;
use App\Http\Controllers\EmploymentStatus\ShowEmploymentStatusController;
use App\Http\Controllers\Entry\EditEntryController;
use App\Http\Controllers\Entry\RegistEntryController;
use App\Http\Controllers\Entry\ShowEntryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Internship\IndexInternships;
use App\Http\Controllers\Interview\EditInterviewController;
use App\Http\Controllers\Interview\RegistInterviewController;
use App\Http\Controllers\Interview\ShowInterviewController;
use App\Http\Controllers\MyActivity\EditMyActivity;
use App\Http\Controllers\MyActivity\RegisterMyActivity;
use App\Http\Controllers\MyActivity\ShowMyActivity;
use App\Http\Controllers\OccupationalCategory\IndexOccupationalCategoryController;
use App\Http\Controllers\Selection\EditSelectionController;
use App\Http\Controllers\Selection\RegistSelectionController;
use App\Http\Controllers\Selection\ShowSelectionController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\EditUserProfileController;
use App\Http\Controllers\User\MyPageController;
use App\Http\Controllers\User\PasswordChangeController;
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
    Route::middleware('auth:sanctum')->post('/password_change', PasswordChangeController::class);
});

Route::get('/home', HomeController::class);
Route::get('/mypage', MyPageController::class);
Route::get('/mypage/{id}', MyPageController::class);

/* ユーザー */
Route::prefix('user')->group(function () {
    Route::post('/', TemporaryRegistationUserController::class);
    Route::post('/delete/{id}', DeleteUserController::class);
    Route::post('/register', RegistUserController::class);
    Route::get('/search', SearchUserController::class);
    Route::post('/edit/{id}', EditUserProfileController::class);
});

/* 企業 */
Route::prefix('company')->group(function () {
    Route::post('/', RegistCompanyController::class);
    Route::get('/show/{company}', ShowCompanyController::class)
        //編集権限
        ->middleware('can:update,company');
    Route::post('/edit/{company}', EditCompanyController::class)
        //編集権限
        ->middleware('can:update,company');
    Route::post('/delete/{company}', DeleteCompanyController::class)
        //削除権限
        ->middleware('can:delete,company');
    Route::get('/search', SearchCompanyController::class);
    
    Route::prefix('detail/{company}',)->group(function () {
        Route::get('/', DetailCompanyController::class);
        Route::get('/users/{user}', DetailCompanyUserController::class);
    });
});

/* 下描き */
Route::prefix('draft')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', IndexDraftController::class);
        Route::post('/', RegistDraftController::class);
        Route::post('/delete/{draft}', DeleteDraftController::class)
            ->middleware('can:delete,draft');
    });

/* エントリー */
Route::prefix('entry')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/', RegistEntryController::class);
        Route::post('/edit/{company_information}', EditEntryController::class)
            // 編集権限
            ->middleware('can:update,company_information');
        Route::get('/show/{company_information}', ShowEntryController::class)
            // 編集権限
            ->middleware('can:update,company_information');
    });

Route::prefix('occupational_category')->group(function () {
    Route::get('/', IndexOccupationalCategoryController::class);
});

/* 選考 */
Route::prefix('selection')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/', RegistSelectionController::class);
        Route::get('/show/{company_information}', ShowSelectionController::class)
            // 編集権限
            ->middleware('can:update,company_information');
        Route::post('/edit/{company_information}', EditSelectionController::class)
            // 編集権限
            ->middleware('can:update,company_information');
    });

/* 面接 */
Route::prefix('interview')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/', RegistInterviewController::class);
        Route::get('/show/{company_information}', ShowInterviewController::class)
            // 編集権限
            ->middleware('can:update,company_information');
        Route::post('/edit/{company_information}', EditInterviewController::class)
            // 編集権限
            ->middleware('can:update,company_information');
    });

/* 企業コメント */
Route::prefix('company_comment')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/', RegistCompanyCommentController::class);
        Route::get('/show/{company_information}', ShowCompanyCommentController::class)
            // 編集権限
            ->middleware('can:update,company_information');
        Route::post('/edit/{company_information}', EditCompanyCommentController::class)
            // 編集権限
            ->middleware('can:update,company_information');
    });

/* 就職状況 */
Route::prefix('employmentstatus')->group(function () {
    Route::get('/show/{id}', ShowEmploymentStatusController::class);
    Route::post('/edit', EditEmploymentStatusController::class);
});

/* マイアクティビティ */
Route::prefix('my_activity')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/', RegisterMyActivity::class);
        Route::get('/show/{company_information}', ShowMyActivity::class)
            // 編集権限
            ->middleware('can:update,company_information');
        Route::post('/edit/{company_information}', EditMyActivity::class)
            // 編集権限
            ->middleware('can:update,company_information');
    });

/* 投稿削除 */
Route::prefix('post')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/delete/{company_information}', DeleteCompanyInformation::class)
            // 削除権限
            ->middleware('can:delete,company_information');
    });

/* インターンシップ */
Route::prefix('internship')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', IndexInternships::class);
    });

//TODO 直す必要あり
// 卒業年次リスト
Route::get('year_of_graduation', function () {
    return response()->json([
        ["id" => 21, "name" => "21"],
        ["id" => 22, "name" => "22"],
        ["id" => 23, "name" => "23"],
        ["id" => 24, "name" => "24"],
    ]);
});
