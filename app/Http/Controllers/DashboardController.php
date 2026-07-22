<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\User;
use App\Models\ActivityLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        /*
        |--------------------------------------------------------------------------
        | Statistik Utama
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $totalCategories = Category::count();

        $totalSuppliers = Supplier::count();

        $totalUsers = User::count();



        /*
        |--------------------------------------------------------------------------
        | Total Stok
        |--------------------------------------------------------------------------
        */

        $totalStock = Product::sum('stock');



        /*
        |--------------------------------------------------------------------------
        | Statistik Transaksi
        |--------------------------------------------------------------------------
        */

        $stockIn = StockIn::sum('qty');

        $stockOut = StockOut::sum('qty');




        /*
        |--------------------------------------------------------------------------
        | Produk Low Stock
        |--------------------------------------------------------------------------
        */

        $lowStocks = Product::whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )
            ->orderBy('stock','asc')
            ->take(5)
            ->get();





        /*
        |--------------------------------------------------------------------------
        | Pending Approval
        |--------------------------------------------------------------------------
        */

        $pendingStockIn = StockIn::where(
            'status',
            'pending'
        )->count();



        $pendingStockOut = StockOut::where(
            'status',
            'pending'
        )->count();



        $pendingApproval = 
            $pendingStockIn + $pendingStockOut;






        /*
        |--------------------------------------------------------------------------
        | Grafik Stock In & Stock Out Bulanan
        |--------------------------------------------------------------------------
        */


        $monthlyStockIn = [];

        $monthlyStockOut = [];

        $months = [];



        for($i = 1; $i <= 12; $i++)
        {

            $months[] = Carbon::create()
                ->month($i)
                ->format('M');



            $monthlyStockIn[] = StockIn::whereMonth(
                    'created_at',
                    $i
                )
                ->sum('qty');



            $monthlyStockOut[] = StockOut::whereMonth(
                    'created_at',
                    $i
                )
                ->sum('qty');

        }





        /*
        |--------------------------------------------------------------------------
        | Recent Transaction
        |--------------------------------------------------------------------------
        */


        $recentStockIn = StockIn::with('product')
            ->latest()
            ->take(5)
            ->get()
            ->map(function($item){

                return (object)[

                    'date'=>$item->date,

                    'type'=>'IN',

                    'product'=>$item->product,

                    'qty'=>$item->qty,

                    'note'=>$item->note

                ];

            });





        $recentStockOut = StockOut::with('product')
            ->latest()
            ->take(5)
            ->get()
            ->map(function($item){

                return (object)[

                    'date'=>$item->date,

                    'type'=>'OUT',

                    'product'=>$item->product,

                    'qty'=>$item->qty,

                    'note'=>$item->note

                ];

            });




        $recentTransactions = $recentStockIn
            ->merge($recentStockOut)
            ->sortByDesc('date')
            ->take(5);






        /*
        |--------------------------------------------------------------------------
        | Activity Log
        |--------------------------------------------------------------------------
        */


        $recentActivities = ActivityLog::latest()
            ->take(5)
            ->get();






        return view('dashboard',compact(

            'totalProducts',

            'totalCategories',

            'totalSuppliers',

            'totalUsers',

            'totalStock',

            'stockIn',

            'stockOut',

            'lowStocks',

            'pendingApproval',

            'pendingStockIn',

            'pendingStockOut',

            'months',

            'monthlyStockIn',

            'monthlyStockOut',

            'recentTransactions',

            'recentActivities'

        ));

    }
}