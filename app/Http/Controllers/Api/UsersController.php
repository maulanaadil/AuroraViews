<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function getAllUsers() {
        $data_users = User::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Data users berhasil diambil',
            'data' => $data_users
        ], 200);
    }

    public function getAllUsersByName(Request $request) {
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

        $data_users = User::where('nama', 'like', '%' . $request->search . '%')
            ->paginate($request->limit);

        return response()->json([
            'status' => 'success',
            'message' => 'Data users berhasil diambil',
            'data' => $data_users
        ], 200);
    }

    public function addUser(Request $reqeust) {
        $validator = Validator::make($reqeust->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'hak' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $data_user = User::create([
            'nama' => $reqeust->nama,
            'username' => $reqeust->username,
            'password' => bcrypt($reqeust->password),
            'hak' => $reqeust->hak,
        ]);

        if ($data_user) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data user berhasil ditambahkan',
                'data' => $data_user
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data user gagal ditambahkan',
            'data' => null
        ], 400);
    }


    public function getUserById($id) {
        $data_user = User::find($id);

        if ($data_user) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data user berhasil diambil',
                'data' => $data_user
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data user gagal diambil',
            'data' => null
        ], 400);
    }

    public function updateUser(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'hak' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $user_exist = User::find($id);

        if (!$user_exist) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data user tidak ditemukan',
                'data' => null
            ], 400);
        }

        $data_user = User::where('id', $id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'hak' => $request->hak,
        ]);

        if ($data_user) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data user berhasil diubah',
                'data' => $data_user
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data user gagal diubah',
            'data' => null
        ], 400);
    }

    public function deleteUser($id) {
        $user_exist = User::find($id);

        if ($user_exist) {
            User::where('id', $id)->delete();
             return response()->json([
                'status' => 'success',
                'message' => 'Data user berhasil dihapus',
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Data user tidak ditemukan',
            'data' => null
        ], 400);

        
    }

    public function deleteBulkUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $data_user = User::whereIn('id', $request->data)->delete();

        if ($data_user) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data user berhasil dihapus',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data user gagal dihapus',
            'data' => null
        ], 400);
    }
}
