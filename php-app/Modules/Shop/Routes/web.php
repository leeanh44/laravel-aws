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
use Modules\Shop\Http\Controllers\LoginController;
use Modules\Shop\Http\Controllers\CategoryController;
use Modules\Shop\Http\Controllers\SubCategoryController;
use Modules\Shop\Http\Controllers\UserController;

Route::prefix('shop')->group(function () {
    /**
     * Route auth
     */
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('shop.login');
    Route::post('/login', [LoginController::class, 'login'])->name('shop.login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('shop.logout');
    Route::get('/logout', [LoginController::class, 'logout'])->name('shop.logout');

    /**
     * Middleware
     */
    Route::group(['middleware' => 'auth:shop'], function () {
        Route::get('/', 'ShopController@index')->name('shop');

        /**
         * Route categories
         */
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('shop.categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('shop.categories.create');
            Route::post('/', [CategoryController::class, 'store'])->name('shop.categories.store');
            Route::get('/detail/{id}', [CategoryController::class, 'detail'])->name('shop.categories.detail');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('shop.categories.edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('shop.categories.update');
            /**
             * Route sub categories
             */
            Route::get('/{id}/children/create', [SubCategoryController::class, 'create'])
                ->name('shop.categories.children.create');
            Route::post('/{id}/children', [SubCategoryController::class, 'store'])
                ->name('shop.categories.children.store');
            Route::get('/children/edit/{id}', [SubCategoryController::class, 'edit'])
                ->name('shop.categories.children.edit');
            Route::put('/children/update/{id}', [SubCategoryController::class, 'update'])
                ->name('shop.categories.children.update');
        });
        /**
         * Route users
         */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('shop.users.index');
        });
    });
});
