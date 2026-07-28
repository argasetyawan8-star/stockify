<?php

namespace App\Interfaces;

interface ManagerDashboardRepositoryInterface
{
    public function getStatistics();

    public function getLowStocks();

    public function getRecentTransactions();

    public function getMonthlyChart();

    public function getPendingApproval();
}
