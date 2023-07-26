<?php

namespace App\Repositories\RecordAnalytics;

use Illuminate\Support\Facades\DB;

class RecordAnalyticsRepository implements RecordAnalyticsRepositoryInterface
{
    /**
     * Get record progress data
     *
     * @return array
     */
    public function getRecordProgress(array $payload)
    {
        $year = date('y', strtotime($payload['periode']));
        $month = date('m', strtotime($payload['periode']));

        return DB::select("Call sp_abm_progresspercabang($year,$month);");
    }

    /**
     * Get hublang record progress data
     *
     * @return array
     */
    public function getHublangRecordProgress(array $payload)
    {
        $officeId = $payload['id_cabang'];
        $year = date('y', strtotime($payload['periode']));
        $month = date('m', strtotime($payload['periode']));

        return DB::select("Call sp_abm_progresspercabang_cab($year,$month,$officeId);");
    }

    /**
     * Get office progress data
     *
     * @return array
     */
    public function getOfficeProgress(array $payload)
    {
        $period = $payload['periode'];
        $startDate = $payload['tanggal_awal'];
        $endDate = $payload['tanggal_akhir'];

        return DB::select("Call sp_abm_progresscater_perday(
            '$period',
            '$startDate',
            '$endDate'
        );");
    }

    /**
     * Get hublang office progress data
     *
     * @return array
     */
    public function getHublangOfficeProgress(array $payload)
    {
        $period = $payload['periode'];
        $startDate = $payload['tanggal_awal'];
        $endDate = $payload['tanggal_akhir'];
        $officeId = $payload['id_cabang'];

        return DB::select("Call sp_abm_progresscater_perday_cab(
            '$period',
            '$startDate',
            '$endDate',
            $officeId
        );");
    }
}
