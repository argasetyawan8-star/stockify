<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\ActivityLog;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();

        $totalStock = Product::sum('stock');

        $stockIn = StockIn::sum('qty');
        $stockOut = StockOut::sum('qty');

        $lowStocks = Product::whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )
            ->orderBy('stock')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Transaction
        |--------------------------------------------------------------------------
        */

        $recentTransactions = StockIn::with('product')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'IN';
                return $item;
            });

        $recentActivities = ActivityLog::latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Approval
        |--------------------------------------------------------------------------
        */

        $pendingStockIn = StockIn::where('status', 'pending')->count();
        $pendingStockOut = StockOut::where('status', 'pending')->count();

        $pendingApproval =
            $pendingStockIn +
            $pendingStockOut;

        /*
        |--------------------------------------------------------------------------
        | Chart
        |--------------------------------------------------------------------------
        */

        $months = [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ];

        $monthlyStockIn = [];
        $monthlyStockOut = [];

        foreach (range(1,12) as $month) {

            $monthlyStockIn[] = StockIn::whereMonth(
                'date',
                $month
            )->sum('qty');

            $monthlyStockOut[] = StockOut::whereMonth(
                'date',
                $month
            )->sum('qty');

        }

        return view('dashboard.admin', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalStock',
            'stockIn',
            'stockOut',
            'lowStocks',
            'recentTransactions',
            'recentActivities',
            'pendingApproval',
            'pendingStockIn',
            'pendingStockOut',
            'months',
            'monthlyStockIn',
            'monthlyStockOut'
        ));
    }
}