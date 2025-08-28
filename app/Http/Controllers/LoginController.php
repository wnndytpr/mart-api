<?php

namespace App\Http\Controllers;

use App\Models\MAnggota;
use App\Models\MToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $anggota = MAnggota::where('email', $email)->first();

        if (!$anggota) {
            return response()->json(['status' => false, 'message' => 'Email tidak ditemukan'], 400);
        }

        if (!Hash::check($password, $anggota->password)) {
            return response()->json(['status' => false, 'message' => 'Password tidak valid'], 400);
        }

        $auth_key = $this->RandomString();

        MToken::create([
            'anggota_id' => $anggota->id,
            'auth_key' => $auth_key
        ]);

        $data = [
            'token' => $auth_key,
            'user' => [
                'id' => $anggota->id,
                'email' => $anggota->email,
            ]
        ];

        return response()->json(['status' => true, 'data' => $data], 200);
    }

    private function RandomString($length = 100)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $characters[rand(0, $charactersLength - 1)];
        }
        return $str;
    }
}