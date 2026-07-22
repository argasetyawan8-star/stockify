<?php

namespace App\Http\Controllers;

use App\Interfaces\ApprovalRepositoryInterface;
use App\Services\ApprovalService;
use Illuminate\Http\Request;
use Exception;

class ApprovalController extends Controller
{
    protected $approvalService;
    protected $approvalRepository;

    public function __construct(
        ApprovalService $approvalService,
        ApprovalRepositoryInterface $approvalRepository
    ) {
        $this->approvalService = $approvalService;
        $this->approvalRepository = $approvalRepository;
    }

    /**
     * Halaman Approval
     */
    public function index()
    {
        $stockIns = $this->approvalRepository
            ->getPendingStockIns();

        $stockOuts = $this->approvalRepository
            ->getPendingStockOuts();

        return view(
            'approvals.index',
            compact(
                'stockIns',
                'stockOuts'
            )
        );
    }

    /**
     * Approve Stock In
     */
    public function approveStockIn($id)
    {
        try {

            $this->approvalService
                ->approveStockIn($id);

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

            $this->approvalService
                ->rejectStockIn(
                    $id,
                    $request->reason
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

            $this->approvalService
                ->approveStockOut($id);

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

            $this->approvalService
                ->rejectStockOut(
                    $id,
                    $request->reason
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