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
    public function getAnalyticsOfficers(DashboardRequest $request)
    {
        return $this->dashboardService->getAnalyticsOfficers($request);
    }

    /**
     * handle get analytics costs
     */
    public function getAnalyticsCosts(DashboardRequest $request)
    {
        return $this->dashboardService->getAnalyticsCosts($request);
    }

    /**
     * handle get analytics records
     */
    public function getAnalyticsRecords(DashboardRequest $request)
    {
        return $this->dashboardService->getAnalyticsRecords($request);
    }
}
