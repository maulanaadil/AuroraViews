<?php

namespace App\Repositories\AnomalyReport;

use Illuminate\Support\Facades\DB;

class AnomalyReportRepository implements AnomalyReportRepositoryInterface
{
    /**
     * fetch export all record that has date diff based on the given period range
     */
    public function getExportDateDiffReport(array $payload)
    {
        // get period from payload with key periode the convert it to month and year
        $period = $payload['periode'];

        // get officeId from payload with key office_id
        $officeId = $payload['office_id'];

        // get regionalId from payload with key regional_id
        $regionalId = $payload['regional_id'];

        // get blockId from payload with key block_id
        $blockId = $payload['block_id'];

        // get the month and year from the given period
        $month = date('m', strtotime($payload['periode']));
        $year = date('Y', strtotime($payload['periode']));

        return DB::select("CALL sp_aurorav2_reportgen_selisihtgl_report($month,$year,$period,$officeId,$regionalId,$blockId);");
    }

    /**
     * fetch anomaly export water usage based on the given period range
     */
    public function getExportWaterUsage(array $payload)
    {
        // get period from payload with key periode the convert it to month and year
        $period = $payload['periode'];

        // get officeId from payload with key office_id
        $officeId = $payload['office_id'];

        // get regionalId from payload with key regional_id
        $regionalId = $payload['regional_id'];

        // get blockId from payload with key block_id
        $blockId = $payload['block_id'];

        // get the month and year from the given period
        $month = date('m', strtotime($payload['periode']));
        $year = date('Y', strtotime($payload['periode']));

        return DB::select("CALL sp_aurorav2_reportgen_pemakaian_report($month,$year,$period,$officeId,$regionalId,$blockId);");
    }

    /**
     * fetch anomaly export equal water usage based on the given period range
     */
    public function getExportEqualWaterUsage(array $payload)
    {
        // get the month and year from the given period
        $month = date('m', strtotime($payload['periode']));
        $year = date('Y', strtotime($payload['periode']));

        return DB::select("CALL sp_aurorav2_reportgen_pemakaiansama_report($month,$year,5000);");
    }

    /**
     * fetch anomaly export of more water usage based on the given period range
     */
    public function getExportOfMoreWaterUsage(array $payload)
    {
        // get period from payload with key periode the convert it to month and year
        $period = $payload['periode'];

        // get officeId from payload with key office_id
        $officeId = $payload['office_id'];

        // get regionalId from payload with key regional_id
        $regionalId = $payload['regional_id'];

        // get blockId from payload with key block_id
        $blockId = $payload['block_id'];

        // get the month and year from the given period
        $month = date('m', strtotime($payload['periode']));
        $year = date('Y', strtotime($payload['periode']));

        return DB::select("CALL sp_aurorav2_reportgen_lebihtgl_report($month,$year,$period,$officeId,$regionalId,$blockId);");
    }
}
