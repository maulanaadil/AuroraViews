<?php

namespace App\Repositories\AnomalyReport;

interface AnomalyReportRepositoryInterface
{
    public function getExportDateDiffReport(array $payload);

    public function getExportWaterUsage(array $payload);

    public function getExportEqualWaterUsage(array $payload);

    public function getExportOfMoreWaterUsage(array $payload);
}
