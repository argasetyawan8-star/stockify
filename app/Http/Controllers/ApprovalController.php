<?php

namespace App\Http\Controllers;

use App\Interfaces\ApprovalRepositoryInterface;
use App\Services\ApprovalService;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Exception;

class ApprovalController extends Controller
{
    protected $approvalRepository;
    protected $approvalService;
    protected $activityLogService;

    public function __construct(
        ApprovalRepositoryInterface $approvalRepository,
        ApprovalService $approvalService,
        ActivityLogService $activityLogService
    ) {
        $this->approvalRepository = $approvalRepository;
        $this->approvalService = $approvalService;
        $this->activityLogService = $activityLogService;
    }

    /**
     * Halaman Approval
     */
    public function index()
    {
        $stockIns = $this->approvalRepository->getPendingStockIns();

        $stockOuts = $this->approvalRepository->getPendingStockOuts();

        return view('approvals.index', compact(
            'stockIns',
            'stockOuts'
        ));
    }

    /**
     * Approve Stock In
     */
    public function approveStockIn($id)
    {
        try {

            $stockIn = $this->approvalService->approveStockIn($id);

            $this->activityLogService->log(
                'Approval',
                'Approve Stock In : ' .
                $stockIn->product->name .
                ' (Qty: ' . $stockIn->qty . ')'
            );

            return back()->with(
                'success',
                'Stock In berhasil di-approve.'
            );

        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    /**
     * Reject Stock In
     */
    public function rejectStockIn(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        try {

            $stockIn = $this->approvalService->rejectStockIn(
                $id,
                $request->reason
            );

            $this->activityLogService->log(
                'Approval',
                'Reject Stock In : ' .
                $stockIn->product->name .
                ' (Qty: ' . $stockIn->qty . ')'
            );

            return back()->with(
                'success',
                'Stock In berhasil ditolak.'
            );

        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    /**
     * Approve Stock Out
     */
    public function approveStockOut($id)
    {
        try {

            $stockOut = $this->approvalService->approveStockOut($id);

            $this->activityLogService->log(
                'Approval',
                'Approve Stock Out : ' .
                $stockOut->product->name .
                ' (Qty: ' . $stockOut->qty . ')'
            );

            return back()->with(
                'success',
                'Stock Out berhasil di-approve.'
            );

        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    /**
     * Reject Stock Out
     */
    public function rejectStockOut(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        try {

            $stockOut = $this->approvalService->rejectStockOut(
                $id,
                $request->reason
            );

            $this->activityLogService->log(
                'Approval',
                'Reject Stock Out : ' .
                $stockOut->product->name .
                ' (Qty: ' . $stockOut->qty . ')'
            );

            return back()->with(
                'success',
                'Stock Out berhasil ditolak.'
            );

        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }
}