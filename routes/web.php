<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;


// Redirect root ('/') to login page
Route::get('/', function () {
    return redirect()->route('login');
});


// Authentication Routes (for guests only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected Routes (Only Authenticated Users Can Access)
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/search', [ProductController::class, 'search'])->name('search');




    // Cart routes
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');

    // Order tracker route
    Route::get('/tracker', function () {
        return view('view_tracker');
    })->name('tracker');

    // Future cart functionality routes (uncomment when ready)
    // Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    // Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    // Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Routes
    // Route::prefix('admin')->middleware(['admin'])->group(function () {});

    // routes/web.php



    Route::middleware(['admin'])->group(function () {
        // Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.welcome');
        // Add more admin routes here
        // Route::get('/welcome', function () {
        //     return view('admin.dashboard');
        // })->name('admin.welcome');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/user_management', [AdminController::class, 'userManagement'])->name('admin.user_management');
        Route::get('/order_menu', [AdminController::class, 'orderMenu'])->name('admin.order_menu');
        Route::post('/order_menu/store', [AdminController::class, 'storeFood'])->name('admin.food.store');


        Route::get('/user_management2', [AdminController::class, 'index'])->name('users.edit'); // REMOVE LANG NI DILI NI TINOOD AYAW KA LIBOG ANI OKAY?
        Route::get('/user_management3', [AdminController::class, 'index'])->name('users.destroy'); // REMOVE LANG NI DILI NI TINOOD AYAW KA LIBOG ANI OKAY?

    });
});

// Publicly accessible about page
Route::get('/about', function () {
    return view('about');
})->name('about');
