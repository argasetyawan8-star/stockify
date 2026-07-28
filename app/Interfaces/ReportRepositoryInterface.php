<?php

namespace App\Interfaces;

interface ReportRepositoryInterface
{
    public function getReport(array $filter = []);

    public function getStockInReport(array $filter = []);

    public function getStockOutReport(array $filter = []);

    public function getStockOpnameReport(array $filter = []);

    public function getInventoryReport(array $filter = []);

    public function getLowStockReport(array $filter = []);
}