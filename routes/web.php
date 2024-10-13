<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DistributorController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\FlashSaleController;


// Guest Route
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () { 
        return view('welcome');
    });
    
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/post-register', [AuthController::class, 'post_register'])->name('post.register');
    Route::post('/post-login', [AuthController::class, 'login']);
})->middleware('guest');

// Admin Route
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    


    // Product Route
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout');

    // Distributor Route
    Route::get('/distributor', [DistributorController::class, 'index'])->name('admin.distributor');
    Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout');
})->middleware('admin');

// User Route
Route::group(['middleware' => 'web'], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    // Route untuk halaman detail produk
Route::get('/user/product/detail/{id}', [UserController::class, 'detail_product'])->name('user.detail');
    Route::get('/user-logout', [AuthController::class, 'user_logout'])->name('user.logout');
})->middleware('web');

// Product Create and Store Route
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');

// Product Route for UserController
Route::get('/user/product/detail/{id}', [UserController::class, 'detail_product'])->name('user.detail.product');
Route::get('/product/purchase/{productId}/{userId}', [UserController::class, 'purchase'])->name('user.purchase');

// Tambahan Route untuk Detail dan Beli
Route::get('/product/detail/{id}', [UserController::class, 'detail_product'])->name('user.product.detail'); // Route untuk melihat detail produk
Route::get('/product/buy/{id}', [UserController::class, 'buy_product'])->name('product.buy'); // Route untuk proses pembelian produk

 // Distributor Route
 Route::get('/distributors', [DistributorController::class, 'index'])->name('admin.distributors');
 Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout');
 // Tambah Distributor
 Route::get('/distributors/create', [DistributorController::class, 'create'])->name('distributors.create');
 Route::post('/distributors', [DistributorController::class, 'store'])->name('distributors.store');
 // Detail Distributor
 Route::get('/admin/distributors/detail/{id}', [DistributorController::class, 'detail'])->name('distributors.detail');
  // Edit Distributor
  Route::get('/distributors/edit/{id}', [DistributorController::class, 'edit'])->name('distributors.edit');
  Route::put('/distributors/update/{id}', [DistributorController::class, 'update'])->name('distributors.update');
 // Delete Distributor
 Route::delete('/distributors/delete/{id}', [DistributorController::class, 'delete'])->name('distributors.delete');

 // Flash Sale Routes
Route::middleware('admin')->group(function () {
    Route::get('/flash_sales', [FlashSaleController::class, 'index'])->name('admin.flash_sales');
    // Route untuk menampilkan form dan menyimpan flash sale
    Route::get('/flash_sales/create', [FlashSaleController::class, 'create'])->name('admin.flash_sales.create');
    Route::post('/flash_sales/store', [FlashSaleController::class, 'store'])->name('admin.flash_sales.store');
    // Route untuk mengedit flash sale
    Route::get('/flash_sales/edit/{id}', [FlashSaleController::class, 'edit'])->name('admin.flash_sales.edit');
    Route::put('/flash_sales/update/{id}', [FlashSaleController::class, 'update'])->name('admin.flash_sales.update');

    // Route untuk menghapus flash sale
    Route::delete('/flash_sales/delete/{id}', [FlashSaleController::class, 'delete'])->name('admin.flash_sales.delete');
});

// User Route untuk menampilkan flash sales
Route::middleware('auth')->get('/flash-sales', function() {
    $flashSales = FlashSale::with('product')->where('start_time', '<=', now())->where('end_time', '>=', now())->get();
    return view('pages.user.flash_sales.index', compact('flashSales'));
})->name('user.flash_sales.index');

