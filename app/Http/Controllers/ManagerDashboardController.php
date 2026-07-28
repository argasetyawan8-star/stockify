<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\StockIn;
use App\Models\StockOut;
use Carbon\Carbon;

class ManagerDashboardController extends Controller
{
   public function index()
{
    // =========================
    // Statistik
    // =========================

    $totalProducts = Product::count();

    $totalStock = Product::sum('stock');

    $lowStockCount = Product::whereColumn('stock', '<=', 'minimum_stock')->count();

    $safeStock = Product::whereColumn('stock', '>', 'minimum_stock')->count();

    $stockInToday = StockIn::whereDate('created_at', today())
    ->sum('qty');

    $stockOutToday = StockOut::whereDate('created_at', today())
    ->sum('qty');

    // =========================
    // Pending Approval
    // =========================

    $pendingStockIn = StockIn::where('status', 'pending')->count();

    $pendingStockOut = StockOut::where('status', 'pending')->count();

    $pendingApproval = $pendingStockIn + $pendingStockOut;

    // =========================
    // Low Stock
    // =========================

    $lowStocks = Product::whereColumn('stock', '<=', 'minimum_stock')
        ->orderBy('stock')
        ->take(5)
        ->get();

    // =========================
    // Recent Transaction
    // =========================

    $stockIns = StockIn::with('product')
        ->latest()
        ->take(5)
        ->get()
        ->map(function ($item) {
            $item->type = 'IN';
            return $item;
        });

    $stockOuts = StockOut::with('product')
        ->latest()
        ->take(5)
        ->get()
        ->map(function ($item) {
            $item->type = 'OUT';
            return $item;
        });

    $recentTransactions = $stockIns
        ->concat($stockOuts)
        ->sortByDesc('created_at')
        ->take(5);

    /*
|--------------------------------------------------------------------------
| Monthly Chart
|--------------------------------------------------------------------------
*/

$months = [];

$monthlyStockIn = [];

$monthlyStockOut = [];

for ($i = 1; $i <= 12; $i++) {

    $months[] = Carbon::create()
        ->month($i)
        ->translatedFormat('M');

    $monthlyStockIn[] = StockIn::whereMonth('date', $i)
        ->sum('qty');

    $monthlyStockOut[] = StockOut::whereMonth('date', $i)
        ->sum('qty');
}

        /*
        |--------------------------------------------------------------------------
        | Top Product
        |--------------------------------------------------------------------------
        */

        $topProducts = StockOut::selectRaw('products.name,SUM(stock_outs.qty) as total_qty')
            ->join('products', 'products.id', '=', 'stock_outs.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Supplier
        |--------------------------------------------------------------------------
        */

        $latestSuppliers = Supplier::latest()
            ->take(5)
            ->get();

       return view('dashboard.manager', compact(
    'totalProducts',
    'totalStock',
    'lowStockCount',
    'safeStock',
    'stockInToday',
    'stockOutToday',
    'pendingStockIn',
    'pendingStockOut',
    'pendingApproval',
    'lowStocks',
    'recentTransactions',
    'months',
    'monthlyStockIn',
    'monthlyStockOut',
    'topProducts',
    'latestSuppliers'
));
    }
}