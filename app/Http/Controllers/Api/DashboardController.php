<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function getAnalytics(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'office_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $month = date('m', strtotime($request->date));
        $year = date('Y', strtotime($request->date));

        $data = DB::select("Call sp_grafik_pencatatanpetugas($month,$year,$request->office_id);");
        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
                'data' => $data,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan',
            'data' => null,
        ], 404);
    }

    public function getAnalyticCost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'office_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $data = DB::select("Call sp_statistikcost_dashboard($request->date,$request->office_id);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
                'data' => $data,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tidak ditemukan',
            'data' => null,
        ], 404);
    }

    public function getAnalyticsPencatatan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'office_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $month = date('m', strtotime($request->date));
        $year = date('Y', strtotime($request->date));
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($request->date)));

        $data = DB::select("Call sp_statistik_dashboard($month,$year,'$yesterday','$request->date',$request->office_id);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditemukan',
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
