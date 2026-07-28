<?php

namespace App\Services;

use App\Interfaces\ReportRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockOpname;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportService
{
    protected ReportRepositoryInterface $reportRepository;

    public function __construct(
        ReportRepositoryInterface $reportRepository
    ) {
        $this->reportRepository = $reportRepository;
    }

    /**
     * ==========================================================
     * MASTER REPORT
     * ==========================================================
     */

    public function getReport(array $filter = [])
    {
        $report = $filter['report'] ?? 'inventory';

        return match ($report) {

            'inventory'     => $this->reportRepository->getInventoryReport($filter),

            'stock_in'      => $this->reportRepository->getStockInReport($filter),

            'stock_out'     => $this->reportRepository->getStockOutReport($filter),

            'stock_opname'  => $this->reportRepository->getStockOpnameReport($filter),

            'low_stock'     => $this->reportRepository->getLowStockReport($filter),

            default         => $this->reportRepository->getInventoryReport($filter),

        };
    }

        /**
     * ==========================================================
     * DASHBOARD SUMMARY
     * ==========================================================
     */
    public function getDashboardSummary(): array
    {
        return $this->reportRepository->getDashboardSummary();
    }

    /**
     * ==========================================================
     * INVENTORY REPORT
     * ==========================================================
     */
    public function getInventoryReport(array $filter = [])
    {
        return $this->reportRepository->getInventoryReport($filter);
    }

    /**
     * ==========================================================
     * LOW STOCK REPORT
     * ==========================================================
     */
    public function getLowStockReport(array $filter = [])
    {
        return $this->reportRepository->getLowStockReport($filter);
    }

    /**
     * ==========================================================
     * STOCK IN REPORT
     * ==========================================================
     */
    public function getStockInReport(array $filter = [])
    {
        return $this->reportRepository->getStockInReport($filter);
    }

    /**
     * ==========================================================
     * STOCK OUT REPORT
     * ==========================================================
     */
    public function getStockOutReport(array $filter = [])
    {
        return $this->reportRepository->getStockOutReport($filter);
    }

    /**
     * ==========================================================
     * STOCK OPNAME REPORT
     * ==========================================================
     */
    public function getStockOpnameReport(array $filter = [])
    {
        return $this->reportRepository->getStockOpnameReport($filter);
    }

    public function exportPdf(array $filter = [])
{
    $reportType = $filter['report'] ?? 'inventory';


    $transactions = collect();



    if ($reportType == 'inventory') {


        $products = Product::with([
            'category',
            'supplier'
        ])
        ->get();



        foreach ($products as $product) {

            $transactions->push([

                'date' => now(),

                'product' => $product,

                'type' => 'Inventory',

                'qty' => $product->stock,

                'description' => 'Stok Saat Ini'

            ]);

        }


    } elseif ($reportType == 'stock_in') {


        $stockIns = StockIn::with([
            'product'
        ])
        ->latest()
        ->get();



        foreach ($stockIns as $item) {


            $transactions->push([

                'date' => $item->date,

                'product' => $item->product,

                'type' => 'Stock In',

                'qty' => $item->qty,

                'description' => $item->reference ?? '-'

            ]);


        }



    } elseif ($reportType == 'stock_out') {



        $stockOuts = StockOut::with([
            'product'
        ])
        ->latest()
        ->get();



        foreach ($stockOuts as $item) {


            $transactions->push([

                'date' => $item->date,

                'product' => $item->product,

                'type' => 'Stock Out',

                'qty' => $item->qty,

                'description' => $item->reference ?? '-'

            ]);

        }



    } elseif ($reportType == 'stock_opname') {


        $opnames = StockOpname::with([
            'product'
        ])
        ->latest()
        ->get();



        foreach ($opnames as $item) {


            $transactions->push([

                'date' => $item->created_at,

                'product' => $item->product,

                'type' => 'Stock Opname',

                'qty' => $item->difference,

                'description' => 'Selisih Stock'

            ]);

        }


    }



    $pdf = Pdf::loadView(
        'reports.pdf',
        [
            'transactions' => $transactions,
            'type' => $reportType
        ]
    );


    return $pdf->download(
        'laporan-stockify.pdf'
    );
}

/**
 * Export Excel Report
 */
public function exportExcel(array $filter = [])
{
    $reportType = $filter['report'] ?? 'inventory';


    return Excel::download(
        new ReportExport($reportType),
        'laporan-stockify.xlsx'
    );
}

}