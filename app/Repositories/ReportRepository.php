<?php

namespace App\Repositories;

use App\Interfaces\ReportRepositoryInterface;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockOpname;

class ReportRepository implements ReportRepositoryInterface
{
    /**
     * Default Report
     */
    public function getReport(array $filter = [])
    {
        return $this->getInventoryReport($filter);
    }

    /**
     * Apply Filter Untuk Transaksi
     */
    protected function applyTransactionFilter(
        $query,
        array $filter = [],
        string $dateColumn = 'date'
    ) {
        // Search Produk
        if (!empty($filter['search'])) {

            $query->whereHas('product', function ($q) use ($filter) {

                $q->where('name', 'like', '%' . $filter['search'] . '%')
                    ->orWhere('sku', 'like', '%' . $filter['search'] . '%');

            });

        }

        // Supplier
        if (!empty($filter['supplier_id'])) {

            $query->whereHas('product', function ($q) use ($filter) {

                $q->where('supplier_id', $filter['supplier_id']);

            });

        }

        // Product
        if (!empty($filter['product_id'])) {

            $query->where('product_id', $filter['product_id']);

        }

        // Status Approval
        if (!empty($filter['status'])) {

            $query->where('status', $filter['status']);

        }

        // Start Date
        if (!empty($filter['start_date'])) {

            $query->whereDate(
                $dateColumn,
                '>=',
                $filter['start_date']
            );

        }

        // End Date
        if (!empty($filter['end_date'])) {

            $query->whereDate(
                $dateColumn,
                '<=',
                $filter['end_date']
            );

        }

        return $query;
    }

    /**
     * Apply Filter Inventory
     */
    protected function applyInventoryFilter(
        $query,
        array $filter = []
    ) {

        // Search
        if (!empty($filter['search'])) {

            $query->where(function ($q) use ($filter) {

                $q->where('name', 'like', '%' . $filter['search'] . '%')
                    ->orWhere('sku', 'like', '%' . $filter['search'] . '%');

            });

        }

        // Supplier
        if (!empty($filter['supplier_id'])) {

            $query->where(
                'supplier_id',
                $filter['supplier_id']
            );

        }

        // Category
        if (!empty($filter['category_id'])) {

            $query->where(
                'category_id',
                $filter['category_id']
            );

        }

        // Status Stock
        if (!empty($filter['status'])) {

            if ($filter['status'] == 'low') {

                $query->whereColumn(
                    'stock',
                    '<=',
                    'minimum_stock'
                );

            }

            if ($filter['status'] == 'safe') {

                $query->whereColumn(
                    'stock',
                    '>',
                    'minimum_stock'
                );

            }

        }

        return $query;
    }

    /**
     * Pagination / Export
     */
    protected function result($query, array $filter = [])
    {
        if (!empty($filter['export'])) {

            return $query->get();

        }

        return $query
            ->paginate(10)
            ->withQueryString();
    }

        /**
     * ==========================================================
     * INVENTORY REPORT
     * ==========================================================
     */
    public function getInventoryReport(array $filter = [])
    {
        $query = Product::query()
            ->with([
                'category',
                'supplier',
            ])
            ->withSum('stockIns as total_stock_in', 'qty')
            ->withSum('stockOuts as total_stock_out', 'qty')
            ->withCount('stockOpnames as total_stock_opname');

        $this->applyInventoryFilter($query, $filter);

        $query->orderBy('name');

        return $this->result($query, $filter);
    }

    /**
     * ==========================================================
     * LOW STOCK REPORT
     * ==========================================================
     */
    public function getLowStockReport(array $filter = [])
    {
        $query = Product::query()
            ->with([
                'category',
                'supplier',
            ])
            ->withSum('stockIns as total_stock_in', 'qty')
            ->withSum('stockOuts as total_stock_out', 'qty')
            ->withCount('stockOpnames as total_stock_opname')
            ->whereColumn('stock', '<=', 'minimum_stock');

        $this->applyInventoryFilter($query, $filter);

        $query->orderBy('stock');

        return $this->result($query, $filter);
    }

        /**
     * ==========================================================
     * STOCK IN REPORT
     * ==========================================================
     */
    public function getStockInReport(array $filter = [])
    {
        $query = StockIn::query()
            ->with([
                'product',
                'product.category',
                'product.supplier',
                'approvedBy',
            ]);

        $this->applyTransactionFilter(
            $query,
            $filter,
            'date'
        );

        $query->latest('date');

        return $this->result($query, $filter);
    }

    /**
     * ==========================================================
     * STOCK OUT REPORT
     * ==========================================================
     */
    public function getStockOutReport(array $filter = [])
    {
        $query = StockOut::query()
            ->with([
                'product',
                'product.category',
                'product.supplier',
                'approvedBy',
            ]);

        $this->applyTransactionFilter(
            $query,
            $filter,
            'date'
        );

        $query->latest('date');

        return $this->result($query, $filter);
    }

    /**
     * ==========================================================
     * STOCK OPNAME REPORT
     * ==========================================================
     */
    public function getStockOpnameReport(array $filter = [])
    {
        $query = StockOpname::query()
            ->with([
                'product',
                'product.category',
                'product.supplier',
                'user',
            ]);

        $this->applyTransactionFilter(
            $query,
            $filter,
            'created_at'
        );

        $query->latest('created_at');

        return $this->result($query, $filter);
    }

        /**
     * ==========================================================
     * DASHBOARD SUMMARY
     * ==========================================================
     */

    public function getDashboardSummary(): array
    {
        return [

            'total_products' => Product::count(),

            'total_stock' => Product::sum('stock'),

            'low_stock' => Product::whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )->count(),

            'stock_in' => StockIn::sum('qty'),

            'stock_out' => StockOut::sum('qty'),

            'stock_opname' => StockOpname::count(),

        ];
    }

}