<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['ok' => true, 'message' => 'Welcome to the API'];
});

Route::prefix('api/v1')->group(function () {
    Route::get('login/{provider}/redirect', [AuthController::class, 'redirect'])->name('login.provider.redirect');
    Route::get('login/{provider}/callback', [AuthController::class, 'callback'])->name('login.provider.callback');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('forgot-password', [AuthController::class, 'sendResetPasswordLink'])->middleware('throttle:5,1')->name('password.email');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.store');
    Route::post('verification-notification', [AuthController::class, 'verificationNotification'])->middleware('throttle:verification-notification')->name('verification.send');
    Route::get('verify-email/{ulid}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('devices/disconnect', [AuthController::class, 'deviceDisconnect'])->name('devices.disconnect');
        Route::get('devices', [AuthController::class, 'devices'])->name('devices');
        Route::get('user', [AuthController::class, 'user'])->name('user');

        Route::post('account/update', [AccountController::class, 'update'])->name('account.update');
        Route::post('account/password', [AccountController::class, 'password'])->name('account.password');

        Route::middleware(['throttle:uploads'])->group(function () {
            Route::post('upload', [UploadController::class, 'image'])->name('upload.image');
        });
    });
});

Route::prefix('api/v1')->group(function() {
    Route::get('/products', [ProductController::class, 'index'])->name('index');
    //Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::get('{category}/products', [ProductController::class, 'index'])->name('category/products.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('index');

    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::patch('/products/{product}', ProductController::class, 'update')->name('update');

    //$actions = ['store', 'index', 'show', 'update', 'destroy'];
    //Route::resource('products', ProductController::class)->only($actions);
    //Route::apiResource('categories', [CategoryController::class, 'index'])->name('index');
    //Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

    //Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    //Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    //Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

