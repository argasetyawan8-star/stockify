<?php

namespace App\Repositories;

use App\Interfaces\ActivityLogRepositoryInterface;
use App\Models\ActivityLog;

class ActivityLogRepository implements ActivityLogRepositoryInterface
{
    public function getAll()
    {
        return ActivityLog::with('user')
            ->latest('created_at')
            ->paginate(10);
    }

    public function getById($id)
    {
        return ActivityLog::with('user')
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        return ActivityLog::create($data);
    }

    public function delete($id)
    {
        $log = ActivityLog::findOrFail($id);

        return $log->delete();
    }
}