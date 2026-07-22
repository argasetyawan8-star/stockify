<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Services\ActivityLogService;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    protected $activityLogService;

    public function __construct(
        ActivityLogService $activityLogService
    ) {
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display report.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Stock In
        |--------------------------------------------------------------------------
        */

        $stockIns = StockIn::with('product')
            ->when($request->start_date, function ($query) use ($request) {
                $query->whereDate('date', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                $query->whereDate('date', '<=', $request->end_date);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id'      => $item->id,
                    'type'    => 'IN',
                    'date'    => $item->date,
                    'product' => $item->product,
                    'qty'     => $item->qty,
                    'note'    => $item->note,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Stock Out
        |--------------------------------------------------------------------------
        */

        $stockOuts = StockOut::with('product')
            ->when($request->start_date, function ($query) use ($request) {
                $query->whereDate('date', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                $query->whereDate('date', '<=', $request->end_date);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id'      => $item->id,
                    'type'    => 'OUT',
                    'date'    => $item->date,
                    'product' => $item->product,
                    'qty'     => $item->qty,
                    'note'    => $item->note,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Merge Transaction
        |--------------------------------------------------------------------------
        */

        $transactions = $stockIns
            ->merge($stockOuts)
            ->sortByDesc('date');

        if ($request->filled('type')) {
            $transactions = $transactions->where(
                'type',
                $request->type
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Activity Log
        |--------------------------------------------------------------------------
        */

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Report',
            'activity'   => 'Melihat laporan transaksi',
            'ip_address' => request()->ip(),
        ]);

        return view(
            'reports.index',
            compact('transactions')
        );
    }

    /**
     * Export PDF
     */
    public function exportPdf(Request $request)
    {
        $stockIns = StockIn::with('product')
            ->get()
            ->map(function ($item) {
                return [
                    'type'    => 'IN',
                    'date'    => $item->date,
                    'product' => $item->product,
                    'qty'     => $item->qty,
                    'note'    => $item->note,
                ];
            });

        $stockOuts = StockOut::with('product')
            ->get()
            ->map(function ($item) {
                return [
                    'type'    => 'OUT',
                    'date'    => $item->date,
                    'product' => $item->product,
                    'qty'     => $item->qty,
                    'note'    => $item->note,
                ];
            });

        $transactions = $stockIns
            ->merge($stockOuts)
            ->sortByDesc('date');

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Report',
            'activity'   => 'Mengunduh laporan PDF',
            'ip_address' => request()->ip(),
        ]);

        $pdf = Pdf::loadView(
            'reports.pdf',
            compact('transactions')
        );

        return $pdf->download('laporan-stock.pdf');
    }
}