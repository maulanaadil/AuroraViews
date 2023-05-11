<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Hak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class OtorisasiController extends Controller
{
    public function getAllOtorisasi()
    {
        $otorisasi = Hak::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditemukan',
            'data' => $otorisasi,
        ], 200);
    }
    public function addOtorisasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_hak' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 400);
        }
        $data = Hak::create([
            'nama_hak' => $request->nama_hak,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditambahkan',
            'data' => $data,
        ], 200);
    }
    public function deleteOtorisasi($id)
    {
        $hak_exist = Hak::find($id);
        if ($hak_exist) {
            Hak::where('id', $id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'data' => null,
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Data otorisasi tidak ditemukan',
            'data' => null,
        ], 400);
    }
}
