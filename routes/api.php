<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\V1\CourseController;
use App\Http\Controllers\V1\InvoiceController;
use App\Http\Controllers\V1\SubscriptionController;
use App\Http\Controllers\V1\UserController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/invoices', InvoiceController::class);
    Route::apiResource('/subscriptions', SubscriptionController::class);
    Route::apiResource('/courses', CourseController::class);
})->middleware('api');
Route::post('/users/login', [UserController::class, 'login']);
