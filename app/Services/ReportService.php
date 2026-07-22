<?php

namespace App\Services;

use App\Interfaces\ReportRepositoryInterface;

class ReportService
{
    protected $reportRepository;

    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function getReport(array $filter = [])
    {
        return $this->reportRepository->getReport($filter);
    }
}