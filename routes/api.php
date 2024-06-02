<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Departments\CreateDepartmentController;
use App\Http\Controllers\Departments\DeleteDepartmentController;
use App\Http\Controllers\Departments\GetDepartmentController;
use App\Http\Controllers\Departments\ListDepartmentsController;
use App\Http\Controllers\Departments\UpdateDepartmentController;
use App\Http\Controllers\Gallery\DeleteImageFromGalleryController;
use App\Http\Controllers\Gallery\GetGalleryController;
use App\Http\Controllers\Gallery\ListGalleryController;
use App\Http\Controllers\Gallery\UploadImageToGalleryController;
use App\Http\Controllers\Services\CreateServiceController;
use App\Http\Controllers\Services\DeleteServiceController;
use App\Http\Controllers\Services\GetServiceController;
use App\Http\Controllers\Services\ListServiceController;
use App\Http\Controllers\Services\UpdateServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [LogoutController::class, 'logout']);

Route::post('/departments/find', GetDepartmentController::class);
Route::post('/departments/list', ListDepartmentsController::class);
Route::post('/departments/new', CreateDepartmentController::class);
Route::post('/departments/update', UpdateDepartmentController::class);
Route::post('/departments/delete', DeleteDepartmentController::class);

Route::post('/services/find', GetServiceController::class);
Route::post('/services/list', ListServiceController::class);
Route::post('/services/new', CreateServiceController::class);
Route::post('/services/update', UpdateServiceController::class);
Route::post('/services/delete', DeleteServiceController::class);

Route::post('/gallery/find', GetGalleryController::class);
Route::post('/gallery/list', ListGalleryController::class);
Route::post('/gallery/new', UploadImageToGalleryController::class);
Route::post('/gallery/delete', DeleteImageFromGalleryController::class);
