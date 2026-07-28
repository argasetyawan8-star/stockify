<?php

namespace App\Services;

use App\Interfaces\ManagerDashboardRepositoryInterface;

class ManagerDashboardService
{
    protected $managerDashboardRepository;

    public function __construct(
        ManagerDashboardRepositoryInterface $managerDashboardRepository
    ) {
        $this->managerDashboardRepository = $managerDashboardRepository;
    }

    /**
     * Statistik Dashboard
     */
    public function getStatistics()
    {
        return $this->managerDashboardRepository->getStatistics();
    }

    /**
     * Low Stock
     */
    public function getLowStocks()
    {
        return $this->managerDashboardRepository->getLowStocks();
    }

    /**
     * Recent Transaction
     */
    public function getRecentTransactions()
    {
        return $this->managerDashboardRepository->getRecentTransactions();
    }

    /**
     * Monthly Chart
     */
    public function getMonthlyChart()
    {
        return $this->managerDashboardRepository->getMonthlyChart();
    }

    /**
     * Pending Approval
     */
    public function getPendingApproval()
    {
        return $this->managerDashboardRepository->getPendingApproval();
    }
}