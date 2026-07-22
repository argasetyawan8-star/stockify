<?php

namespace App\Services;

use App\Interfaces\ActivityLogRepositoryInterface;

class ActivityLogService
{
    protected $activityLogRepository;

    public function __construct(
        ActivityLogRepositoryInterface $activityLogRepository
    )
    {
        $this->activityLogRepository = $activityLogRepository;
    }

    public function getAll()
    {
        return $this->activityLogRepository->getAll();
    }

    public function getById($id)
    {
        return $this->activityLogRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->activityLogRepository->store($data);
    }

    public function delete($id)
    {
        return $this->activityLogRepository->delete($id);
    }

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