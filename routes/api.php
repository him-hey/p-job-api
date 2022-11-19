<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\JobPostController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post("/postJob", [JobPostController::class, 'store']);
    Route::get("/getJobs", [JobPostController::class, 'index']);
    Route::get("/jobDetail/{id}", [JobPostController::class, 'show']);
    Route::get("/closeJob/{id}", [JobPostController::class, 'edit']);
    Route::delete("/deleteJob/{id}", [JobPostController::class, 'destroy']);
    Route::put("/updateJob/{id}", [JobPostController::class, 'update']);
});
Route::post('/company/create', [CompanyController::class, 'create']);
Route::post('/company/login', [CompanyController::class, 'companyLogin']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/jobpost', JobPostController::class);
});