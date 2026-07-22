<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;

class ActivityLogController extends Controller
{
    protected $activityLogService;

    public function __construct(
        ActivityLogService $activityLogService
    ) {
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activityLogs = $this->activityLogService->getAll();

        return view('activity-logs.index', compact('activityLogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource.
     */
    public function store()
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activityLog = $this->activityLogService->getById($id);

        return view('activity-logs.show', compact('activityLog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource.
     */
    public function update()
    {
        abort(404);
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        $this->activityLogService->delete($id);

        return redirect()
            ->route('activity-logs.index')
            ->with('success', 'Activity Log berhasil dihapus.');
    }
}