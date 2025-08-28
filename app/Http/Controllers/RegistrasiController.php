<?php

namespace App\Http\Controllers;

use App\Models\MAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function registrasi(Request $request) 
    {
        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ];

        $model = new MAnggota();
        $model->create($data);

        return response()->json([
            'status' => true,
            'message' => 'Registrasi Berhasil',
        ], 200);
    }
}