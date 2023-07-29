<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Request\DashboardRequest;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * handle get analytics officers
     */
    public function getAnalyticsOfficers(DashboardRequest $requestData)
    {
        return $this->dashboardService->getAnalyticsOfficers($requestData);
    }

    /**
     * handle get analytics costs
     */
    public function getAnalyticsCosts(DashboardRequest $requestData)
    {
        return $this->dashboardService->getAnalyticsCosts($requestData);
    }

    /**
     * handle get analytics records
     */
    public function getAnalyticsRecords(DashboardRequest $requestData)
    {
        return $this->dashboardService->getAnalyticsRecords($requestData);
    }
}
