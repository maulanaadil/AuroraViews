<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LaporanAnomaliController extends Controller
{
    public function exportexcel1Action(Request $request) {
        $validator = Validator::make($request->all(), [
            'office_id' => 'required|integer',
            'periode' => 'required|date',
            'regional_id' => 'required|integer',
            'block_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $bulan = date('m', strtotime($request->periode));
        $tahun = date('Y', strtotime($request->periode));

        $data = DB::select("CALL sp_aurorav2_reportgen_selisihtgl_report($bulan,$tahun,$request->periode,$request->office_id,$request->regional_id,$request->block_id);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan',
            'data' => null
        ], 404);
    }

    public function exportexcel1Action2(Request $request) {
        $validator = Validator::make($request->all(), [
            'office_id' => 'required|integer',
            'periode' => 'required|date',
            'regional_id' => 'required|integer',
            'block_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $bulan = date('m', strtotime($request->periode));
        $tahun = date('Y', strtotime($request->periode));

        $data = DB::select("CALL sp_aurorav2_reportgen_pemakaian_report($bulan,$tahun,$request->periode,$request->office_id,$request->regional_id,$request->block_id);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan',
            'data' => null
        ], 404);
    }
    
    public function exportexcel1Action3(Request $request) {
        $validator = Validator::make($request->all(), [
            'periode' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $bulan = date('m', strtotime($request->periode));
        $tahun = date('Y', strtotime($request->periode));

        $data = DB::select("CALL sp_aurorav2_reportgen_pemakaiansama_report($bulan,$tahun,5000);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan',
            'data' => null
        ], 404);
    }

     public function exportexcel1Action4(Request $request) {
        $validator = Validator::make($request->all(), [
            'office_id' => 'required|integer',
            'periode' => 'required|date',
            'regional_id' => 'required|integer',
            'block_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $bulan = date('m', strtotime($request->periode));
        $tahun = date('Y', strtotime($request->periode));

        $data = DB::select("CALL sp_aurorav2_reportgen_lebihtgl_report($bulan,$tahun,$request->periode,$request->office_id,$request->regional_id,$request->block_id);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan',
            'data' => null
        ], 404);
    }

    public function selectRegionalAction(Request $request) {
         $validator = Validator::make($request->all(), [
            'office_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $data = DB::select("CALL sp_master_wilayah_get($request->office_id);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan',
            'data' => null
        ], 404);
    }

    public function selectBlocksAction(Request $request) {
         $validator = Validator::make($request->all(), [
            'regional_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $data = DB::select("CALL sp_master_block_get($request->regional_id);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
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
