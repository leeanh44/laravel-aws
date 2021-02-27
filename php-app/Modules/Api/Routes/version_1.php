<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Api\Http\Controllers\V1\AuthController;
use Modules\Api\Http\Controllers\V1\ShopCategoryController;
use Modules\Api\Http\Controllers\V1\MasterCategoryController;
use Modules\Api\Http\Controllers\V1\ShopController;
use Modules\Api\Http\Controllers\V1\NotificationController;
use Modules\Api\Http\Controllers\V1\ShopUserController;
use Modules\Api\Http\Controllers\V1\UserController;
use Modules\Api\Http\Controllers\V1\ProductController;

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

/** @see AuthController::login() */
Route::post('login', [AuthController::class, 'login']);
Route::post('phone/verify', [AuthController::class, 'verifyPhone']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('test-auth', [AuthController::class, 'testAuth']);
    /**
     * Master category routes
     */
    Route::get('/categories', [MasterCategoryController::class, 'index']);
    Route::get('master-category/{id}/shops', [ShopController::class, 'listShopByMasterCategory']);

    /**
     * Shop routes
     */
    Route::group(['prefix' => 'shop'], function () {
        Route::get('/{id}', [ShopController::class, 'detail']);
        /**
         * Category routes
         */
        Route::get('/{id}/categories', [ShopCategoryController::class, 'index']);
        /**
         * Notification routes
         */
        Route::get('/{id}/notifications', [NotificationController::class, 'index']);
    });

    /**
     * Notification routes
     */
    Route::get('/notification/{id}', [NotificationController::class, 'detail']);

    /**
     * User routes
     */
    Route::group(['prefix' => 'user'], function () {
        Route::get('', [UserController::class, 'detail']);
        Route::post('', [UserController::class, 'update']);
        /**
         * Shop user routes
         */
        Route::post('/shop', [ShopUserController::class, 'store']);
        Route::get('/shops', [ShopUserController::class, 'index']);
        Route::get('/shops/{id}', [ShopUserController::class, 'detail']);
        /**
         * User devices routes
         */
        Route::post('/devices', [UserController::class, 'updateDevice']);
    });

    /**
     * Products routes
     */
    Route::group(['prefix' => 'products'], function () {
        Route::get('/sub-category/{id}', [ProductController::class, 'listBySubCategory']);
        Route::get('/{id}', [ProductController::class, 'detail']);
    });
});
