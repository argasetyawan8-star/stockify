<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Halaman Report
     */
    public function index(Request $request)
{
    $filter = $request->all();

    $reportType = $request->get('report', 'inventory');

    $reports = match ($reportType) {

        'inventory' => $this->reportService->getInventoryReport($filter),

        'stock_in' => $this->reportService->getStockInReport($filter),

        'stock_out' => $this->reportService->getStockOutReport($filter),

        'stock_opname' => $this->reportService->getStockOpnameReport($filter),

        'low_stock' => $this->reportService->getLowStockReport($filter),

        default => $this->reportService->getInventoryReport($filter),

    };

    // Dropdown Filter
    $products = Product::orderBy('name')->get();

    $suppliers = Supplier::orderBy('name')->get();

    // Statistik
    $statistics = [

        'total_product' => Product::count(),

        'stock' => Product::sum('stock'),

        'low_stock' => Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->count(),

    ];

    return view('reports.index', [

        'reports' => $reports,

        'products' => $products,

        'suppliers' => $suppliers,

        'statistics' => $statistics,

    ]);
}

    /**
     * Export PDF
     */
    public function exportPdf(Request $request)
    {
        return $this->reportService->exportPdf($request->all());
    }

    /**
     * Export Excel
     */
    public function exportExcel(Request $request)
    {
        return $this->reportService->exportExcel($request->all());
    }
}