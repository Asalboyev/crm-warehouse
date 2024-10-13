<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\CustomersController;
use App\Http\Controllers\Api\v1\LoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\ProductController;



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


Route::prefix('v1')->group(function () {

    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');



    Route::middleware(['auth:sanctum', 'role:admin,seller'])->group(function () {
        Route::get('customers', [CustomersController::class, 'apiIndex'])->name('api.customers.index');
        Route::get('customer/{id}', [CustomersController::class, 'apiShow'])->name('api.customer.show');
        Route::post('customers', [CustomersController::class, 'apiStore'])->name('api.customers.store');
        Route::post('customer/{id}', [CustomersController::class, 'apiUpdate'])->name('api.customer.update');
        Route::post('orders', [OrderController::class, 'store']);
        Route::get('orders/{order}', [OrderController::class, 'show']);
        Route::get('orders', [OrderController::class, 'index']);
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
        Route::put('products/{id}/add-package', [ProductController::class, 'addPackage'])->name('products.add-package');
        Route::put('products/{id}/update-price', [ProductController::class, 'updatePrice'])->name('products.update-price');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy']);
        Route::middleware(['role:admin'])->group(function () {
            Route::delete('customer/{id}', [CustomersController::class, 'apiDestroy'])->name('api.customer.destroy');
            Route::put('/orders/{order}', [OrderController::class, 'update']);
        });
    });
    Route::middleware(['auth:sanctum', 'role:admin,seller,warehouseman'])->group(function () {

        Route::middleware(['role:seller,warehouseman'])->group(function () {
            Route::get('products/{id}/sklad', [ProductController::class, 'getSklad']);
            Route::get('products', [ProductController::class, 'index'])->name('products.index');
            Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
            Route::get('/sales/product/{id}', [\App\Http\Controllers\Backend\MainController::class, 'getSalesDetailsForProduct']);



        });
    });


});




