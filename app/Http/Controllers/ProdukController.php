<?php

namespace App\Http\Controllers;

use App\Models\MProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{   // ini untuk data yang kalo di posman send nya satu satu, mksdnya kaya buat data nya tu satu satu gt g skligus kya si bulk
    public function create(Request $request)
    {
        $data = [
            'kode_produk' => $request->input('kode_produk'),
            'nama_produk' => $request->input('nama_produk'),
            'harga' => $request->input('harga')
        ];

        $produk = MProduk::create($data);

        return response()->json([
            'status' => true,
            'data' => $produk
        ], 200);
    }

    // bulk bisa tambah banyak data produk sekaligus
    public function bulkCreate(Request $request)
    {
        $produkList = $request->all();

        if (!is_array($produkList)) {
            return response()->json(['status' => false, 'message' => 'Format data harus berupa array'], 400);
        }

        $inserted = [];
        foreach ($produkList as $data) {
            $inserted[] = MProduk::create([
                'kode_produk' => $data['kode_produk'] ?? null,
                'nama_produk' => $data['nama_produk'] ?? null,
                'harga' => $data['harga'] ?? null
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil ditambahkan (bulk)',
            'data' => $inserted
        ], 201);
    }

    // list semua produk
    public function list()
    {
        $produk = MProduk::all();

        return response()->json([
            'status' => true,
            'data' => $produk
        ], 200);
    }

    // detail produk by id
    public function detail($id)
    {
        $produk = MProduk::find($id);

        if (!$produk) {
            return response()->json(['status' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $produk
        ], 200);
    }

    // update produk
    public function ubah(Request $request, $id)
    {
        $produk = MProduk::find($id);

        if (!$produk) {
            return response()->json(['status' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }

        $produk->update([
            'kode_produk' => $request->input('kode_produk'),
            'nama_produk' => $request->input('nama_produk'),
            'harga' => $request->input('harga')
        ]);

        return response()->json([
            'status' => true,
            'data' => $produk
        ], 200);
    }

    // hapus produk
    public function hapus($id)
    {
        $produk = MProduk::find($id);

        if (!$produk) {
            return response()->json(['status' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }

        $produk->delete();

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }
}