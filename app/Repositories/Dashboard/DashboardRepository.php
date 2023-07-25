<?php

namespace App\Repositories\Dashboard;

use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardRepositoryInterface
{
    /**
     * handle get officers analytic
     *
     * @return array
     */
    public function getAnalyticsOfficers(array $payload)
    {
        $month = date('m', strtotime($payload['date']));
        $year = date('Y', strtotime($payload['date']));
        $officeId = $payload['office_id'];

        return DB::select("Call sp_grafik_pencatatanpetugas($month,$year,$officeId);");
    }

    /**
     * handle get costs analytic
     *
     * @return array
     */
    public function getAnalyticsCosts(array $payload)
    {
        $date = $payload['date'];
        $officeId = $payload['office_id'] ?? 0;

        return DB::select("Call sp_statistikcost_dashboard($date,$officeId);");
    }

    /**
     * handle get records analytic
     *
     * @return array
     */
    public function getAnalyticsRecords(array $payload)
    {
        $month = date('m', strtotime($payload['date']));
        $year = date('Y', strtotime($payload['date']));
        $officeId = $payload['office_id'] ?? 0;

        return DB::select("Call sp_grafik_pencatatanpetugas($month,$year,$officeId);");
    }
}
