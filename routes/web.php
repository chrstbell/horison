<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

// Public routes (no authentication required)
Route::get('/admin-login', [AuthController::class, 'showLogin'])->name('admin_login');
Route::get('/login', [AuthController::class, 'showUserLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout-page', [AuthController::class, 'logoutPage'])->name('logout_page');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes (all roles)
Route::middleware(['auth.check'])->group(function () {
    Route::get('/receipt/{orderId}', [UserController::class, 'receipt'])->name('receipt');
});

// User routes (requires authentication and user role)
Route::middleware(['auth.check', 'role:user'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home');

    Route::get('/about', function () {
        return view('user.about');
    })->name('about');

    Route::get('/status', [UserController::class, 'status'])->name('status');

    Route::get('/menu', [UserController::class, 'menu'])->name('menu');
    Route::get('/kategori-item/{category}', [UserController::class, 'kategoriItem'])->name('kategori_item');
    Route::get('/kategori', [UserController::class, 'kategori'])->name('kategori');
    Route::get('/checkout', [UserController::class, 'checkout'])->name('checkout');

    // Order routes for users
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// Admin routes (requires authentication and admin role)
Route::prefix('admin')->name('admin.')
    ->middleware(['auth.check', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/makanan',  [AdminController::class, 'makanan'])->name('makanan');
        Route::get('/minuman',  [AdminController::class, 'minuman'])->name('minuman');
        Route::get('/new-menu', [AdminController::class, 'newMenu'])->name('new-menu');
        Route::get('/tambah-menu',  [AdminController::class, 'tambahMenu'])->name('tambah_menu');
        Route::get('/edit-menu/{id}',  [AdminController::class, 'editMenu'])->name('edit_menu');

        Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('pengguna');
        Route::get('/promo',    [AdminController::class, 'promo'])->name('promo');

        Route::get('/menu/filter/{category}/{subcategory}', [MenuController::class, 'filterMenu'])
            ->name('menu.filter');

        // DATA MANAGEMENT
        Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
        Route::put('/menus/{id}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/menus/{id}', [MenuController::class, 'delete'])->name('menus.delete');
        Route::patch('/menus/update_available/{id}', [MenuController::class, 'updateAvailable'])
            ->name('menus.update_available');

        Route::post('/promos', [PromoController::class, 'store'])->name('promos.store');
        Route::put('/promos/{id}', [PromoController::class, 'update'])->name('promos.update');
        Route::delete('/promos/{id}', [PromoController::class, 'delete'])->name('promos.delete');

        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{id}/logout', [UserController::class, 'logoutUser'])->name('users.logout');
        Route::post('/users/add-time', [UserController::class, 'addTimeToAllUsers'])->name('users.addTime');
        Route::post('/users/reset-all', [UserController::class, 'resetAllUsers'])->name('users.resetAll');

        // Order management for admin
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/orders/{id}/history', [OrderController::class, 'history'])->name('orders.history');
        Route::get('/orders-statistics', [OrderController::class, 'statistics'])->name('orders.statistics');
    });


// Kitchen routes (requires authentication and kitchen role)
Route::prefix('dapur')->name('dapur.')
    ->middleware(['auth.check', 'role:kitchen'])
    ->group(function () {
        Route::get('/dashboard', [DapurController::class, 'dashboard'])->name('dashboard');

        // Order management for kitchen
        Route::get('/orders', [OrderController::class, 'kitchenOrders'])->name('orders');
        Route::get('/orders/history-by-date', [DapurController::class, 'historyByDate'])->name('orders.history_by_date');
        Route::get('/orders/active', [DapurController::class, 'activeOrders'])->name('orders.active');
        Route::get('/orders/{id}', [DapurController::class, 'orderDetail'])->name('orders.detail');
        Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update_status');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/orders/{id}/history', [OrderController::class, 'history'])->name('orders.history');
    });
