<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;

class SidebarComposer
{
    public function compose(View $view)
    {
        $pendingApproval =
            StockIn::where('status', 'pending')->count()
            +
            StockOut::where('status', 'pending')->count();

        $lowStockCount =
            Product::whereColumn('stock', '<=', 'minimum_stock')
                ->count();

        $view->with([
            'pendingApproval' => $pendingApproval,
            'lowStockCount'   => $lowStockCount,
        ]);
    }
}