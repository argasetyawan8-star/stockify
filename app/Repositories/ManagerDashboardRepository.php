<?php

namespace App\Repositories;

use App\Interfaces\ManagerDashboardRepositoryInterface;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Approval;
use Illuminate\Support\Facades\DB;

class ManagerDashboardRepository implements ManagerDashboardRepositoryInterface
{
    /**
     * Statistik Dashboard
     */
    public function getStatistics()
    {
        return [

            'totalProducts' => Product::count(),

            'totalStock' => Product::sum('stock'),

            'stockInToday' => StockIn::whereDate(
                'date',
                today()
            )->sum('qty'),

            'stockOutToday' => StockOut::whereDate(
                'date',
                today()
            )->sum('qty'),

            'lowStock' => Product::whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )->count(),

        ];
    }

    /**
     * Low Stock
     */
    public function getLowStocks()
    {
        return Product::whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )
            ->orderBy('stock')
            ->take(10)
            ->get();
    }

    /**
     * Recent Transaction
     */
    public function getRecentTransactions()
    {
        $stockIns = StockIn::with('product')
            ->latest('date')
            ->take(5)
            ->get()
            ->map(function ($item) {

                $item->type = 'IN';

                return $item;

            });

        $stockOuts = StockOut::with('product')
            ->latest('date')
            ->take(5)
            ->get()
            ->map(function ($item) {

                $item->type = 'OUT';

                return $item;

            });

        return $stockIns
            ->merge($stockOuts)
            ->sortByDesc('date')
            ->take(10);
    }

    /**
     * Monthly Chart
     */
    public function getMonthlyChart()
    {
        $months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        $stockIn = [];

        $stockOut = [];

        for ($i = 1; $i <= 12; $i++) {

            $stockIn[] = StockIn::whereYear(
                    'date',
                    now()->year
                )
                ->whereMonth('date', $i)
                ->sum('qty');

            $stockOut[] = StockOut::whereYear(
                    'date',
                    now()->year
                )
                ->whereMonth('date', $i)
                ->sum('qty');
        }

        return [

            'months' => $months,

            'stockIn' => $stockIn,

            'stockOut' => $stockOut,

        ];
    }

    /**
     * Pending Approval
     */
    public function getPendingApproval()
    {
        if (!class_exists(\App\Models\Approval::class)) {

            return [

                'total' => 0,

                'stockIn' => 0,

                'stockOut' => 0,

            ];
        }

        return [

            'total' => Approval::where(
                'status',
                'pending'
            )->count(),

            'stockIn' => Approval::where([
                'type' => 'stock_in',
                'status' => 'pending'
            ])->count(),

            'stockOut' => Approval::where([
                'type' => 'stock_out',
                'status' => 'pending'
            ])->count(),

        ];
    }
}