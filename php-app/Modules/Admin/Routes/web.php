<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\LoginController;
use Modules\Admin\Http\Controllers\MasterCategoryController;
use Modules\Admin\Http\Controllers\ShopController;

Route::prefix('admin')->group(function () {
    /**
     * Route auth
     */
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    /**
     * Middleware
     */
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('home');

        /**
         * Route master categories
         */
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [MasterCategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/create', [MasterCategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('/', [MasterCategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('/edit/{id}', [MasterCategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::put('/update/{id}', [MasterCategoryController::class, 'update'])->name('admin.categories.update');
        });

        /**
         * Route master categories
         */
        Route::group(['prefix' => 'shops'], function () {
            Route::get('/', [ShopController::class, 'index'])->name('admin.shops.index');
            Route::get('/create', [ShopController::class, 'create'])->name('admin.shops.create');
            Route::post('/', [ShopController::class, 'store'])->name('admin.shops.store');
            Route::get('/edit/{id}', [ShopController::class, 'edit'])->name('admin.shops.edit');
            Route::put('/update/{id}', [ShopController::class, 'update'])->name('admin.shops.update');
        });
    });
});
