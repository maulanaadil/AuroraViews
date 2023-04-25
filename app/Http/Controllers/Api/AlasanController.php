<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AlasanController extends Controller
{
    public function getAllAlasan()
    {
        $data_alasan = DB::select('CALL sp_master_alasan_load();');

        if ($data_alasan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data alasan berhasil diambil',
                'data' => $data_alasan,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data alasan gagal diambil',
            'data' => null,
        ], 400);
    }

    public function getAlasanById($id)
    {
        $data_alasan = Alasan::find($id);

        if ($data_alasan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data alasan berhasil diambil',
                'data' => $data_alasan,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data alasan gagal diambil',
            'data' => null,
        ], 400);
    }

    public function addAlasan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alasan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 400);
        }

        $data_alasan = Alasan::create([
            'alasan' => $request->alasan,
        ]);

        if ($data_alasan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data alasan berhasil ditambahkan',
                'data' => $data_alasan,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data alasan gagal ditambahkan',
            'data' => null,
        ], 400);
    }

    public function updateAlasan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alasan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 400);
        }

        $alasan_exist = Alasan::find($id);

        if (! $alasan_exist) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data alasan tidak ditemukan',
                'data' => null,
            ], 400);
        }

        $data_alasan = Alasan::where('alasan_id', $id)->update([
            'alasan' => $request->alasan,
        ]);

        if ($data_alasan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data alasan berhasil diubah',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data alasan gagal diubah',
            'data' => null,
        ], 400);
    }

    public function deleteAlasan($id)
    {
        $alasan_exist = Alasan::find($id);

        if ($alasan_exist) {
            $alasan_exist->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data alasan berhasil dihapus',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data alasan tidak ditemukan',
            'data' => null,
        ], 400);
    }
}
