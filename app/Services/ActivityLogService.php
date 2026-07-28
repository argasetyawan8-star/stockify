<?php

namespace App\Services;

use App\Interfaces\ActivityLogRepositoryInterface;

class ActivityLogService
{
    protected $activityLogRepository;

    public function __construct(
        ActivityLogRepositoryInterface $activityLogRepository
    ) {
        $this->activityLogRepository = $activityLogRepository;
    }

    /**
     * Semua activity
     */
    public function getAll()
    {
        return $this->activityLogRepository->getAll();
    }

    /**
     * Detail activity
     */
    public function getById($id)
    {
        return $this->activityLogRepository->getById($id);
    }

    /**
     * Simpan activity
     */
    public function store(array $data)
    {
        return $this->activityLogRepository->store($data);
    }

    /**
     * Hapus activity
     */
    public function delete($id)
    {
        return $this->activityLogRepository->delete($id);
    }

    /**
     * Activity terbaru
     */
    public function latest($limit = 10)
    {
        return $this->activityLogRepository->latest($limit);
    }

    /**
     * Helper untuk mencatat aktivitas
     */
    public function log($module, $activity)
    {
        return $this->activityLogRepository->store([
            'user_id'    => auth()->id(),
            'module'     => $module,
            'activity'   => $activity,
            'ip_address' => request()->ip(),
        ]);
    }
}