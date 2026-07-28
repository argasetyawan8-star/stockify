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
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StaffDashboardController;



class DashboardController extends Controller
{
    public function index()
    {

         $user = Auth::user();

        if ($user->hasRole('Admin')) {
            return app(AdminDashboardController::class)->index();
        }

        if ($user->hasRole('Manajer Gudang')) {
            return app(ManagerDashboardController::class)->index();
        }

        if ($user->hasRole('Staff Gudang')) {
            return app(StaffDashboardController::class)->index();
        }

        abort(403);
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