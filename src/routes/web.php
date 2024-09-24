<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Dashboard\VendorController as VendorDashboardController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::with(['getCategory','vendor'])->get();
    return view('welcome',[
        'products' => $products
    ]);
})->name('home');

Route::get('products/search',[ProductController::class, 'search'])->name('products.search');

Route::group(['middleware' => ['guest']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login',[AuthController::class, 'getLogin'])->name('admin.login');
        Route::post('/login',[AuthController::class, 'postLogin'])->name('admin.postLogin');
    });
    Route::prefix('vendor')->group(function () {
        Route::get('/login',[VendorController::class, 'getLogin'])->name('vendor.login');
        Route::post('/login',[VendorController::class, 'postLogin'])->name('vendor.postLogin');
        Route::get('/register', [VendorController::class, 'index'])->name('vendor.register');
        Route::post('/register', [VendorController::class, 'register'])->name('vendor.register.post');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard',[AuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('vendors',[VendorDashboardController::class, 'index'])->name('admin.vendors');
        Route::get('vendor/show/{id}',[VendorDashboardController::class, 'show'])->name('admin.vendor.show');
        Route::put('vendor/update/{id}',[VendorDashboardController::class, 'update'])->name('admin.vendor.update');
    });
});

Route::group(['middleware' => ['auth.vendor']], function () {
    Route::prefix('vendor')->group(function () {
        Route::get('/dashboard',[VendorController::class, 'dashboard'])->name('vendor.dashboard');
        Route::get('/logout',[VendorController::class, 'logout'])->name('vendor.logout');

        Route::prefix('products')->name('vendor.products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProductController::class, 'update'])->name('update');
            Route::get('/{id}', [ProductController::class, 'destroy'])->name('destroy');
        });
    });
});
