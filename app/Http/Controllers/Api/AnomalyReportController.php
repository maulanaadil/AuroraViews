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
    public function getExportDateDiffReport(AnomalyReportRequest $request)
    {
        return $this->anomalyReportService->getExportDateDiffReport($request);
    }

    /**
     * handle get anomaly report water usage based on the given period range
     */
    public function getExportWaterUsage(AnomalyReportRequest $request)
    {
        return $this->anomalyReportService->getExportWaterUsage($request);
    }

    /**
     * handle get anomaly report equal water usage based on the given period range
     */
    public function getExportEqualWaterUsage(AnomalyReportRequestOnlyPeriod $request)
    {
        return $this->anomalyReportService->getExportEqualWaterUsage($request);
    }

    /**
     * handle get anomaly report of more water usage based on the given period range
     */
    public function getExportOfMoreWaterUsage(AnomalyReportRequest $request)
    {
        return $this->anomalyReportService->getExportOfMoreWaterUsage($request);
    }
}
