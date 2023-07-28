<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Request\RecordAnalytics\RecordOfficeProgressAnalyticsRequest;
use App\Request\RecordAnalytics\RecordProgressAnalyticsRequest;
use App\Services\RecordAnalyticsService;

class RecordAnalyticsController extends Controller
{
    protected $recordAnalyticsService;

    public function __construct(RecordAnalyticsService $recordAnalyticsService)
    {
        $this->recordAnalyticsService = $recordAnalyticsService;
    }

    /**
     * display all record progress data based on period and office
     */
    public function getRecordProgress(RecordProgressAnalyticsRequest $requestData)
    {
        return $this->recordAnalyticsService->getRecordProgress($requestData);
    }

    /**
     * display all record office progress data based on period and office
     */
    public function getOfficeProgress(RecordOfficeProgressAnalyticsRequest $requestData)
    {
        return $this->recordAnalyticsService->getOfficeProgress($requestData);
    }
}
