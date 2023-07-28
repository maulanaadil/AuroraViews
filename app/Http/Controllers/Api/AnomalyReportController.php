<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Request\AnomalyReport\AnomalyReportRequest;
use App\Request\AnomalyReport\AnomalyReportRequestOnlyPeriod;
use App\Services\AnomalyReportService;

class AnomalyReportController extends Controller
{
    protected $anomalyReportService;

    public function __construct(AnomalyReportService $anomalyReportService)
    {
        $this->anomalyReportService = $anomalyReportService;
    }

    /**
     * handle get anomaly report that has date diff based on the given period range
     */
    public function getExportDateDiffReport(AnomalyReportRequest $requestData)
    {
        return $this->anomalyReportService->getExportDateDiffReport($requestData);
    }

    /**
     * handle get anomaly report water usage based on the given period range
     */
    public function getExportWaterUsage(AnomalyReportRequest $requestData)
    {
        return $this->anomalyReportService->getExportWaterUsage($requestData);
    }

    /**
     * handle get anomaly report equal water usage based on the given period range
     */
    public function getExportEqualWaterUsage(AnomalyReportRequestOnlyPeriod $requestData)
    {
        return $this->anomalyReportService->getExportEqualWaterUsage($requestData);
    }

    /**
     * handle get anomaly report of more water usage based on the given period range
     */
    public function getExportOfMoreWaterUsage(AnomalyReportRequest $requestData)
    {
        return $this->anomalyReportService->getExportOfMoreWaterUsage($requestData);
    }
}
