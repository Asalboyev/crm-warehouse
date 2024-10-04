<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Bakend\PropertyTypeController;
use App\Http\Controllers\Backend\CategoriesController;

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

//     Admin group middleware
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'AdminDashboard'])->name('dashboard');
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::post('users', [AdminController::class, 'users_create'])->name('users.create');
    Route::get('user/{id}/edit', [AdminController::class, 'users_edit'])->name('user.edit');
    Route::put('user/{id}', [AdminController::class, 'user_update'])->name('user.update');
    Route::put('user/{id}/updatePassword', [AdminController::class, 'user_updatePassword'])->name('user.updatePassword');

    Route::get('categories', [\App\Http\Controllers\Backend\CategoriesController::class, 'index'])->name('categories.index');
    Route::post('categories',[CategoriesController::class, 'store'])->name('categories.store');

    Route::get('category/{id}/edit',[CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('categories/{id}',[CategoriesController::class, 'update'])->name('categories.update');




    Route::post('categories/ajax',[\App\Http\Controllers\Backend\CategoriesController::class, 'ajax'])->name('categories.ajax');





    Route::delete('user/{id}/destroy', [AdminController::class, 'users_destroy'])->name('user.destroy');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
});
//     Agent group middleware

Route::middleware(['auth','role:warehouseman'])->group(function () {
    Route::get('/warehouseman/dashboard', [AgentController::class, 'AgentDashboard'])->name('warehouseman.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');




   Route::middleware(['auth', 'role:admin'])->group(function (){
       Route::controller(PropertyTypeController::class)->group(function (){
           Route::get('/all/type', 'AllType')->name('all.type');
       });
   });
























