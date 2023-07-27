<?php

namespace App\Repositories\ReadMeter;

use App\Models\Billing;
use Illuminate\Support\Facades\DB;

class ReadMeterRepository implements ReadMeterRepositoryInterface
{
    /**
     * Query to load rates meter data
     */
    public function loadRatesMeter()
    {
        return DB::select('CALL sp_master_tarif_load();');
    }

    /**
     * Query to load office data by id
     */
    public function getOfficeById(int $officeId)
    {
        return DB::select("CALL sp_master_office_load_datameter($officeId);");
    }

    /**
     * Query to load info customer data, and limit the result by limit
     */
    public function getInfoCustomer(array $payload)
    {
        return Billing::select(
            'bill_mergeym',
            'is_verify',
            'bill_date',
            'cust_code123',
            'cust_name',
            'bill_stand1',
            'bill_stand2',
            'bill_totalusage'
        )
        ->selectRaw('(select alasan from alasan where alasan_id=billing.bill_userange1only) as alasan')
        ->selectRaw('(select of_name from office where of_id=billing.of_id) as cab')
        ->selectRaw('(select writer_user_name from m_writer where writer_id=billing.bill_userange12only) as user')
        ->selectRaw('(select trfType_init from tarifftype where trfType_id=billing.trfType_id) as nama_tarif')
        ->get()->take($payload['limit']);
    }

    /**
     * Query to load position customer data by customer code and bill mergeym
     */
    public function getPositionCustomer(array $payload)
    {
        $customerCode = $payload['customer_code'];
        $billMergeym = $payload['bill_mergeym'];

        return DB::select("CALL sp_datameter_infocust('$customerCode', $billMergeym);");
    }
}
