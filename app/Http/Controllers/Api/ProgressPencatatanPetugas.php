<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProgressPencatatanPetugas extends Controller
{
    /**
     * @error
     * This function error on procedure. Must be fixed and ask Ijay.
     */
    public function getProgressPencatatan(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_cabang' => 'required|integer',
            'periode' => 'required|date',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'id_hak' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null
            ], 400);
        }

        $isHakHublang = $request->id_hak == 2;

        if ($isHakHublang) {
            $data = DB::select("Call sp_abm_progresscater_perday_cab($request->periode,$request->tanggal_awal,$request->tanggal_akhir,$request->id_cabang);");

            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil diambil',
                    'data' => $data
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }
        $data = DB::select("Call sp_abm_progresscater_perday($request->periode,'$request->tanggal_awal','$request->tanggal_awal');");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diambil',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan',
            'data' => null
        ], 404);
    }   
}
