<?php

namespace App\Interfaces;

interface ReportRepositoryInterface
{
    public function getReport(array $filter = []);
}