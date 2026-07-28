<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Services\ActivityLogService;

class ApprovalService
{
    protected $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /**
     * APPROVE STOCK IN
     */
    public function approveStockIn($id)
    {
        return DB::transaction(function () use ($id) {

            $stockIn = StockIn::with('product')->findOrFail($id);

            if ($stockIn->status !== 'pending') {
                throw new Exception('Transaksi sudah diproses.');
            }

            $product = Product::findOrFail($stockIn->product_id);

            // Tambah stok
            $product->increment('stock', $stockIn->qty);

            // Update status
            $stockIn->update([
                'status'           => 'approved',
                'approved_by'      => Auth::id(),
                'approved_at'      => now(),
                'rejection_reason' => null,
            ]);

            // Activity Log
            $this->activityLogService->log(
                'Approval',
                'Approve Stock In : ' .
                $stockIn->product->name .
                ' (Qty: ' .
                $stockIn->qty .
                ')'
            );

            return $stockIn;
        });
    }

    /**
     * REJECT STOCK IN
     */
    public function rejectStockIn($id, $reason = null)
    {
        return DB::transaction(function () use ($id, $reason) {

            $stockIn = StockIn::with('product')->findOrFail($id);

            if ($stockIn->status !== 'pending') {
                throw new Exception('Transaksi sudah diproses.');
            }

            $stockIn->update([
                'status'           => 'rejected',
                'approved_by'      => Auth::id(),
                'approved_at'      => now(),
                'rejection_reason' => $reason,
            ]);

            // Activity Log
            $this->activityLogService->log(
                'Approval',
                'Reject Stock In : ' .
                $stockIn->product->name .
                ' (Qty: ' .
                $stockIn->qty .
                ')'
            );

            return $stockIn;
        });
    }

    /**
     * APPROVE STOCK OUT
     */
    public function approveStockOut($id)
    {
        return DB::transaction(function () use ($id) {

            $stockOut = StockOut::with('product')->findOrFail($id);

            if ($stockOut->status !== 'pending') {
                throw new Exception('Transaksi sudah diproses.');
            }

            $product = Product::findOrFail($stockOut->product_id);

            // Cek stok
            if ($product->stock < $stockOut->qty) {
                throw new Exception(
                    'Stok produk tidak mencukupi.'
                );
            }

            // Kurangi stok
            $product->decrement(
                'stock',
                $stockOut->qty
            );

            // Update status
            $stockOut->update([
                'status'           => 'approved',
                'approved_by'      => Auth::id(),
                'approved_at'      => now(),
                'rejection_reason' => null,
            ]);

            // Activity Log
            $this->activityLogService->log(
                'Approval',
                'Approve Stock Out : ' .
                $stockOut->product->name .
                ' (Qty: ' .
                $stockOut->qty .
                ')'
            );

            return $stockOut;
        });
    }

    /**
     * REJECT STOCK OUT
     */
    public function rejectStockOut($id, $reason = null)
    {
        return DB::transaction(function () use ($id, $reason) {

            $stockOut = StockOut::with('product')->findOrFail($id);

            if ($stockOut->status !== 'pending') {
                throw new Exception('Transaksi sudah diproses.');
            }

            $stockOut->update([
                'status'           => 'rejected',
                'approved_by'      => Auth::id(),
                'approved_at'      => now(),
                'rejection_reason' => $reason,
            ]);

            // Activity Log
            $this->activityLogService->log(
                'Approval',
                'Reject Stock Out : ' .
                $stockOut->product->name .
                ' (Qty: ' .
                $stockOut->qty .
                ')'
            );

            return $stockOut;
        });
    }
}