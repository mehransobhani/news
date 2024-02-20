<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['as' => 'admin.'], function () {
    Route::group(['as' => 'category.', 'prefix' => 'category'], function () {
        Route::get("index", [CategoryController::class, "index"])->name("index");
        Route::get("create", [CategoryController::class, "create"])->name("create");
        Route::get("edit", [CategoryController::class, "edit"])->name("edit");
        Route::post("store", [CategoryController::class, "store"])->name("store");
        Route::post("update", [CategoryController::class, "update"])->name("update");
    });

    Route::group(['as' => 'new.', 'prefix' => 'new'], function () {
        Route::get("index", [NewController::class, "index"])->name("index");
        Route::get("create", [NewController::class, "create"])->name("create");
        Route::get("edit", [NewController::class, "edit"])->name("edit");
        Route::post("store", [NewController::class, "store"])->name("store");
        Route::post("update", [NewController::class, "update"])->name("update");
    });

});
