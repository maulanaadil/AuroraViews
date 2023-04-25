<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\MWriter;
use App\Models\MWriterArea;
use App\Models\Office;
use App\Models\Regional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PemetaanPetugasController extends Controller
{
    public function getSelectRegional(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 400);
        }

        $data = DB::select("CALL sp_master_wilayah_get($request->id);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data regional berhasil diambil',
                'data' => $data,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data regional gagal diambil',
            'data' => null,
        ], 400);
    }

    public function getSelectBlocks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 400);
        }

        $data = DB::select("CALL sp_master_block_get($request->id);");

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data blok berhasil diambil',
                'data' => $data,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data blok gagal diambil',
            'data' => null,
        ], 400);
    }

    public function getAreaByPetugasId(Request $request)
    {
        $block_ids = [];

        $validator = Validator::make($request->all(), [
            'petugas_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 400);
        }

        $data_petugas = MWriter::where('writer_id', $request->petugas_id)->first();

        if (! $data_petugas) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data petugas tidak ditemukan',
                'data' => null,
            ], 400);
        }

        $data_area = MWriterArea::where('writer_id', $request->petugas_id)->get();
        foreach ($data_area as $area) {
            $block_ids[] = $area->block_id;
        }

        $data_blocks = Block::whereIn('block_id', $block_ids)->get();

        if ($data_blocks->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data blocks berhasil diambil',
                'data' => [
                    'petugas' => $data_petugas,
                    'area' => $data_blocks,
                ],
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data area petugas gagal diambil',
            'data' => null,
        ], 400);
    }

    public function getDataJalan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'block_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 400);
        }

        $data = DB::select("call sp_master_petugasarea_cekblock($request->id, $request->block_id)");

        if (! $data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data jalan gagal diambil',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data jalan berhasil diambil',
            'data' => $data,
        ], 200);
    }

    public function addPemetaanPetugas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'petugas_id' => 'required|integer',
            'block_id' => 'required|integer',
            'rgn_id' => 'required|integer',
            'of_id' => 'required|integer',
            'tgl_download' => 'integer',
            'tgl_max_upload' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 400);
        }

        $petugas_exists = MWriter::find($request->petugas_id);
        if (! $petugas_exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data petugas tidak ditemukan',
                'data' => null,
            ], 400);
        }

        $block_exists = Block::find($request->block_id);
        if (! $block_exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data blok tidak ditemukan',
                'data' => null,
            ], 400);
        }

        $regional_exists = Regional::find($request->rgn_id);
        if (! $regional_exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data regional tidak ditemukan',
                'data' => null,
            ], 400);
        }

        $office_exists = Office::find($request->of_id);
        if (! $office_exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data office tidak ditemukan',
                'data' => null,
            ], 400);
        }

        if ($request->tgl_download > $request->tgl_max_upload) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tanggal download tidak boleh lebih besar dari tanggal maksimal upload',
                'data' => null,
            ], 400);
        }

        $data = MWriterArea::create([
            'writer_id' => $request->petugas_id,
            'block_id' => $request->block_id,
            'rgn_id' => $request->rgn_id,
            'of_id' => $request->of_id,
            'tgl_download' => $request->tgl_download,
            'tgl_max_upload' => $request->tgl_max_upload,
        ]);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data pemetaan petugas berhasil ditambahkan',
                'data' => $data,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data pemetaan petugas gagal ditambahkan',
            'data' => null,
        ], 400);
    }

    public function deletePemetaanPetugas($id)
    {
        $pemetaan_petugas_exists = MWriterArea::find($id);

        if ($pemetaan_petugas_exists) {
            $pemetaan_petugas_exists->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data pemetaan petugas berhasil dihapus',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data pemetaan petugas tidak ditemukan',
            'data' => null,
        ], 400);
    }
}
