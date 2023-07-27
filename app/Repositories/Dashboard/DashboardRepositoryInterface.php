<?php

namespace App\Repositories\Dashboard;

interface DashboardRepositoryInterface
{
    public function getAnalyticsOfficers(array $payload);

    public function getAnalyticsCosts(array $payload);

    public function getAnalyticsRecords(array $payload);
}
