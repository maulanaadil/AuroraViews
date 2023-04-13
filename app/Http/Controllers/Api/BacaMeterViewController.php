<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BacaMeterViewController extends Controller
{
    public function index(Request $request) {
        $validator = Validator::make($request->all(), [
            'office_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $data_office  = DB::select("CALL sp_master_office_load_datameter($request->office_id);");
        $data_petugas = DB::select("CALL sp_master_petugas_load();");
        $data_tarif = DB::select("CALL sp_master_tarif_load();");
        $data_alasan = DB::select("CALL sp_master_alasan_load();");

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditemukan',
            'data' => [
                'office' => $data_office,
                'petugas' => $data_petugas,
                'tarif' => $data_tarif,
                'alasan' => $data_alasan,
            ]
        ], 200);
    }

    public function cariDataBacaMeter(Request $request) {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $billings = Billing::select(
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
        ->get()->take($request->limit);

        if ($billings) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data BacaMeter berhasil ditemukan',
                    'data' => $billings
                ], 200);
            }

        return response()->json([
            'status' => 'error',
            'message' => 'Data BacaMeter tidak ditemukan',
            'data' => null
        ], 404);
    }

	public function divinfopelangganAction(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_code' => 'required|string|max:20',
            'bill_mergeym' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $data = DB::select("CALL sp_datameter_infocust('$request->customer_code', $request->bill_mergeym);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Info Pelanggan berhasil ditemukan',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data Info Pelanggan  tidak ditemukan',
            'data' => null
        ], 404);
    }

    public function divmapAction(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer_code' => 'required|string|max:20',
            'bill_mergeym' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $data = DB::select("CALL sp_datameter_infolonglat('$request->customer_code', $request->bill_mergeym);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Map berhasil ditemukan',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data Map tidak ditemukan',
            'data' => null
        ], 404);
    }

    public function divfotorumahAction()
    {
      
    }
    public function divfotostandAction()
    {
      
    }
    public function divfotostandlaluAction()
    {
      
    }
    public function divfotostandrevisiAction()
    {
        
    }

    public function simpanManualAction(Request $request)
    {
        
        if($this->$request->sess_hak==10)
        {
            echo 0;
            exit;
        }
        // echo $this->$request->sess_hak."asd";exit;
        $custcode=$request->getPost("custcode");
        $periode=$request->getPost("periode");
        $stand1=$request->getPost("stand1");
        $stand2=$request->getPost("stand2");
        $totalusage=$request->getPost("totalusage");
        
        $sql="CALL sp_datameter_setbacamanual(".$stand2.",".$totalusage.",'".$custcode."',".$periode.",".$request->sess_id.")";
//      echo $sql;exit;
        $jumlah=0;
        unset($executesql);
        if($jumlah>0)
        {
            $this->insertLog($this->$request->sess_id,"Baca manual","Baca manual Data Meter","Kode : $custcode ,periode :$periode ,stand1 : $stand1 , stand2:$stand2,usage:$totalusage","Berhasil");
        }
        else
        {
            $this->insertLog($this->$request->sess_id,"Baca manual","Baca manual Data Meter","Kode : $custcode ,periode :$periode , stand1 : $stand1 , stand2:$stand2,usage:$totalusage","Gagal");
        }
        
        echo $jumlah;
    }
    public function editKoreksiAction(Request $request)
    {
        
        if($request->sess_hak==10)
        {
            echo 0;
            exit;
        }
        // echo $this->$request->sess_hak."asd";exit;
		// $custcode=$request->custcode;
		// $periode=$request->periode;
		// $stand1=$request->stand1;
		$stand2=$request->stand2;
		$totalusage=$request->totalusage;
        
        $data=DB::select("CALL sp_datameter_setkoreksi_user(".$request->stand1.",".$request->stand2.",".$request->totalusage.",'".$request->custcode."',".$request->periode.",".$request->sess_id.");");
        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Koreksi berhasil disimpan',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data Koreksi gagal disimpan',
            'data' => null
        ], 404);
    }
}
