<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function getAllPetugas() {
        $data_petugas = DB::select('CALL sp_master_petugas_load();');

        if ($data_petugas) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data petugas berhasil diambil',
                'data' => $data_petugas
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data petugas gagal diambil',
            'data' => null
        ], 400);
    }

    public function getAllPetugasByName(Request $request) {
        $validator = Validator::make($request->all(), [
            'search' => 'string|max:255',
            'page' => 'integer',
            'limit' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $data_petugas = MWriter::where('writer_name', 'like', '%' . $request->search . '%')
            ->paginate($request->limit);


        if ($data_petugas) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data petugas berhasil diambil',
                'data' => $data_petugas
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data petugas gagal diambil',
            'data' => null
        ], 400);
    }

    public function addPetugas(Request $request) {
        $validator = Validator::make($request->all(), [
            'writer_name' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'writer_user_name' => 'required|string|max:255|unique:m_writer',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $data_petugas = MWriter::create([
            'writer_name' => $request->writer_name,
            'no_telp' => $request->notelp,
            'alamat' => $request->alamat,
            'writer_user_name' => $request->writer_user_name,
            'writer_password' => bcrypt($request->password),
        ]);

        if ($data_petugas) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data petugas berhasil ditambahkan',
                'data' => $data_petugas
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data petugas gagal ditambahkan',
            'data' => null
        ], 400);

    }

    public function getPetugasById($id) {
        $data_petugas = MWriter::find($id);

        if ($data_petugas) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data petugas berhasil ditemukan',
                'data' => $data_petugas
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data petugas tidak ditemukan',
            'data' => null
        ], 400);
    }

    public function updatePetugas(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'writer_name' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'writer_user_name' => 'required|string|max:255|unique:m_writer',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $petugas_exist = MWriter::find($id);
        
        if (!$petugas_exist) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data petugas tidak ditemukan',
            ], 400);
        }

        $data_petugas = MWriter::where('writer_id', $id)->update([
            'writer_name' => $request->writer_name,
            'no_telp' => $request->notelp,
            'alamat' => $request->alamat,
            'writer_user_name' => $request->writer_user_name,
            'password' => $request->password,
        ]);

        if ($data_petugas) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data petugas berhasil diubah',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data petugas gagal diubah',
        ], 400);
    }

    public function deletePetugas($id) {
        $petugas_exist = MWriter::find($id);

        if ($petugas_exist) {

            MWriter::where('writer_id', $id)->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Data petugas berhasil dihapus',
            ], 200);
        }

        return response()->json([
                'status' => 'error',
                'message' => 'Data petugas tidak ditemukan',
            ], 400);
    }
}

