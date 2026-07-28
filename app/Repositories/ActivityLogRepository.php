<?php

namespace App\Repositories;

use App\Interfaces\ActivityLogRepositoryInterface;
use App\Models\ActivityLog;

class ActivityLogRepository implements ActivityLogRepositoryInterface
{
    /**
     * Semua activity
     *
     * Aktivitas terbaru ditampilkan terlebih dahulu.
     */
    public function getAll()
    {
        return ActivityLog::with('user')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10);
    }

    /**
     * Detail activity
     */
    public function getById($id)
    {
        return ActivityLog::with('user')
            ->findOrFail($id);
    }

    /**
     * Simpan activity
     */
    public function store(array $data)
    {
        return ActivityLog::create($data);
    }

    /**
     * Hapus activity
     */
    public function delete($id)
    {
        $log = ActivityLog::findOrFail($id);

        return $log->delete();
    }

    /**
     * Activity terbaru
     */
    public function latest($limit = 10)
    {
        return ActivityLog::with('user')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit($limit)
            ->get();
    }
}