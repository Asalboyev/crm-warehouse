<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\MainController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return redirect()->route('login');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('dashboard', [MainController::class, 'getCustomerStats'])->name('dashboard');


    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::post('users', [AdminController::class, 'users_create'])->name('users.create');
    Route::get('user/{id}/edit', [AdminController::class, 'users_edit'])->name('user.edit');
    Route::put('user/{id}', [AdminController::class, 'user_update'])->name('user.update');
    Route::put('user/{id}/updatePassword', [AdminController::class, 'user_updatePassword'])->name('user.updatePassword');
    Route::delete('user/{id}/destroy', [AdminController::class, 'users_destroy'])->name('user.destroy');
    //end  user
    //categories
    Route::get('categories', [\App\Http\Controllers\Backend\CategoriesController::class, 'index'])->name('categories.index');
    Route::post('categories',[CategoriesController::class, 'store'])->name('categories.store');
    Route::get('category/{id}/edit',[CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('category/{id}',[CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('category/{id}/destroy', [CategoriesController::class, 'destroy'])->name('category.destroy');
    Route::post('/categories_ajax',[CategoriesController::class,'ajax'])->name('categories.ajax');
    // end categories

    Route::get('products', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{id}/show', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');

    //order start

    Route::get('orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{id}/show', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');

    // ending order

    Route::put('/product/{id}/update-price', [ProductController::class, 'updatePrice'])->name('product.updatePrice');
    Route::put('product/{id}/add-package', [ProductController::class, 'addPackage'])->name('product.addPackage');
    Route::post('/product/{id}/add-item', [ProductController::class, 'addItem'])->name('product.addItem');
    // customers
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('customers',[CustomerController::class, 'store'])->name('customers.store');
    Route::get('customer/{id}/edit',[CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('customer/{id}',[CustomerController::class, 'update'])->name('customer.update');
    Route::delete('customer/{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy');
    // end customers
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
});

//     Agent group middleware

Route::middleware(['auth','role:warehouseman'])->group(function () {
    Route::get('/warehouseman/dashboard', [AgentController::class, 'AgentDashboard'])->name('warehouseman.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');





















































