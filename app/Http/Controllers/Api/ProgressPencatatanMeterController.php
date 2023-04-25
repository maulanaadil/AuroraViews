<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProgressPencatatanMeterController extends Controller
{
    public function getProgressPercabang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_cabang' => 'required|integer',
            'periode' => 'required|date',
            'id_hak' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 400);
        }

        $month = date('m', strtotime($request->periode));
        $year = date('Y', strtotime($request->periode));
        $isHakHublang = $request->id_hak == 2;

        if ($isHakHublang) {
            $data = DB::select("Call sp_abm_progresspercabang_cab($year,$month,$request->id_cabang);");

            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil diambil',
                    'data' => $data,
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'data' => null,
            ], 404);
        }
        $data = DB::select("Call sp_abm_progresspercabang($year,$month);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diambil',
                'data' => $data,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan',
            'data' => null,
        ], 404);
    }
}
