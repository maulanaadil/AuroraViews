<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'username'      => 'required',
            'password'      => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $credentials = $request->only('username', 'password');

        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid username or password'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'login success',
            'data' => [
                'user' => auth()->guard('api')->user(),
                'token' => $token
            ]
        ], 200);
    }

    public function register(Request $request) {
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

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'hak' => $request->hak,
        ]);

        if ($user) {
            return response()->json([
                'status' => 'success',
                'message' => 'user sudah terdaftar',
                'data' => $user
            ], 201);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'gagal mendaftarkan user',
        ], 400 );
    }

    public function logout() {
        auth()->guard('api')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'user telah keluar'
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
