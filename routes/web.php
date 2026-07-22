<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('permission:view dashboard')
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    Route::get('/categories', [CategoryController::class, 'index'])
        ->middleware('permission:view categories')
        ->name('categories.index');

    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->middleware('permission:manage categories')
        ->name('categories.create');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->middleware('permission:manage categories')
        ->name('categories.store');

    Route::get('/categories/{category}', [CategoryController::class, 'show'])
        ->middleware('permission:view categories')
        ->name('categories.show');

    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->middleware('permission:manage categories')
        ->name('categories.edit');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->middleware('permission:manage categories')
        ->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->middleware('permission:manage categories')
        ->name('categories.destroy');

    /*
    |--------------------------------------------------------------------------
    | Suppliers
    |--------------------------------------------------------------------------
    */

    Route::get('/suppliers', [SupplierController::class, 'index'])
        ->middleware('permission:view suppliers')
        ->name('suppliers.index');

    Route::get('/suppliers/create', [SupplierController::class, 'create'])
        ->middleware('permission:manage suppliers')
        ->name('suppliers.create');

    Route::post('/suppliers', [SupplierController::class, 'store'])
        ->middleware('permission:manage suppliers')
        ->name('suppliers.store');

    Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])
        ->middleware('permission:view suppliers')
        ->name('suppliers.show');

    Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])
        ->middleware('permission:manage suppliers')
        ->name('suppliers.edit');

    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])
        ->middleware('permission:manage suppliers')
        ->name('suppliers.update');

    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])
        ->middleware('permission:manage suppliers')
        ->name('suppliers.destroy');

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    Route::get('/products', [ProductController::class, 'index'])
        ->middleware('permission:view products')
        ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->middleware('permission:manage products')
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->middleware('permission:manage products')
        ->name('products.store');

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->middleware('permission:view products')
        ->name('products.show');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->middleware('permission:manage products')
        ->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->middleware('permission:manage products')
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->middleware('permission:manage products')
        ->name('products.destroy');

    /*
    |--------------------------------------------------------------------------
    | Stock In
    |--------------------------------------------------------------------------
    */

    Route::get('/stock-ins', [StockInController::class, 'index'])
        ->middleware('permission:view stock in')
        ->name('stock-ins.index');

    Route::get('/stock-ins/create', [StockInController::class, 'create'])
        ->middleware('permission:manage stock in')
        ->name('stock-ins.create');

    Route::post('/stock-ins', [StockInController::class, 'store'])
        ->middleware('permission:manage stock in')
        ->name('stock-ins.store');

    Route::get('/stock-ins/{stock_in}/edit', [StockInController::class, 'edit'])
        ->middleware('permission:manage stock in')
        ->name('stock-ins.edit');

    Route::put('/stock-ins/{stock_in}', [StockInController::class, 'update'])
        ->middleware('permission:manage stock in')
        ->name('stock-ins.update');

    Route::delete('/stock-ins/{stock_in}', [StockInController::class, 'destroy'])
        ->middleware('permission:manage stock in')
        ->name('stock-ins.destroy');

    /*
    |--------------------------------------------------------------------------
    | Stock Out
    |--------------------------------------------------------------------------
    */

    Route::resource('stock-outs', StockOutController::class)
        ->middleware([
            'index' => 'permission:view stock out',
            'show' => 'permission:view stock out',
            'create' => 'permission:manage stock out',
            'store' => 'permission:manage stock out',
            'edit' => 'permission:manage stock out',
            'update' => 'permission:manage stock out',
            'destroy' => 'permission:manage stock out',
        ]);

    /*
    |--------------------------------------------------------------------------
    | Stock Opname
    |--------------------------------------------------------------------------
    */

    Route::get('/stock-opnames', [StockOpnameController::class, 'index'])
        ->middleware('permission:view stock opname')
        ->name('stock-opnames.index');

    Route::get('/stock-opnames/create', [StockOpnameController::class, 'create'])
        ->middleware('permission:manage stock opname')
        ->name('stock-opnames.create');

    Route::post('/stock-opnames', [StockOpnameController::class, 'store'])
        ->middleware('permission:manage stock opname')
        ->name('stock-opnames.store');

    Route::get('/stock-opnames/{stock_opname}', [StockOpnameController::class, 'show'])
        ->middleware('permission:view stock opname')
        ->name('stock-opnames.show');

    Route::delete('/stock-opnames/{stock_opname}', [StockOpnameController::class, 'destroy'])
        ->middleware('permission:manage stock opname')
        ->name('stock-opnames.destroy');

    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', [ReportController::class, 'index'])
        ->middleware('permission:view reports')
        ->name('reports.index');

    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])
        ->middleware('permission:view reports')
        ->name('reports.pdf');

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::get('/users', [UserController::class, 'index'])
        ->middleware('permission:view users')
        ->name('users.index');

    Route::get('/users/create', [UserController::class, 'create'])
        ->middleware('permission:manage users')
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->middleware('permission:manage users')
        ->name('users.store');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->middleware('permission:view users')
        ->name('users.show');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->middleware('permission:manage users')
        ->name('users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->middleware('permission:manage users')
        ->name('users.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->middleware('permission:manage users')
        ->name('users.destroy');

    /*
    |--------------------------------------------------------------------------
    | Activity Logs
    |--------------------------------------------------------------------------
    */

    Route::get('/activity-logs', [ActivityLogController::class, 'index'])
        ->middleware('permission:view activity logs')
        ->name('activity-logs.index');

    Route::get('/activity-logs/{activity_log}', [ActivityLogController::class, 'show'])
        ->middleware('permission:view activity logs')
        ->name('activity-logs.show');

    Route::delete('/activity-logs/{activity_log}', [ActivityLogController::class, 'destroy'])
        ->middleware('permission:manage activity logs')
        ->name('activity-logs.destroy');
});

        Route::middleware(['auth'])->group(function () {

    Route::get('/approvals', [
        ApprovalController::class,
        'index'
    ])->name('approvals.index');


    // Stock In Approval
    Route::post('/approvals/stock-in/{id}/approve',
        [ApprovalController::class,'approveStockIn']
    )->name('approvals.stockin.approve');


    Route::post('/approvals/stock-in/{id}/reject',
        [ApprovalController::class,'rejectStockIn']
    )->name('approvals.stockin.reject');



    // Stock Out Approval
    Route::post('/approvals/stock-out/{id}/approve',
        [ApprovalController::class,'approveStockOut']
    )->name('approvals.stockout.approve');


    Route::post('/approvals/stock-out/{id}/reject',
        [ApprovalController::class,'rejectStockOut']
    )->name('approvals.stockout.reject');


});


    Route::middleware(['auth'])
    ->group(function(){

        Route::get('/settings',
            [SettingController::class,'index']
        )
        ->name('settings.index');

    });
require __DIR__ . '/auth.php';