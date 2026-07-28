<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;

class StaffDashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Dashboard Cards
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $stockInToday = StockIn::whereDate('date', today())
            ->sum('qty');

        $stockOutToday = StockOut::whereDate('date', today())
            ->sum('qty');

        $lowStocks = Product::whereColumn('stock', '<=', 'minimum_stock')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Recent Stock In
        |--------------------------------------------------------------------------
        */

        $recentStockIns = StockIn::with('product')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Stock Out
        |--------------------------------------------------------------------------
        */

        $recentStockOuts = StockOut::with('product')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Low Stock Products
        |--------------------------------------------------------------------------
        */

        $lowStockProducts = Product::whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock')
            ->take(5)
            ->get();

        return view('dashboard.staff', compact(
            'totalProducts',
            'stockInToday',
            'stockOutToday',
            'lowStocks',
            'recentStockIns',
            'recentStockOuts',
            'lowStockProducts'
        ));
    }
}