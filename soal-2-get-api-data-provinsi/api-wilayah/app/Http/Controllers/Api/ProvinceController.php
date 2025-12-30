<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    // Tampilkan Semua Data
    public function index()
    {
        return response()->json(Province::all(), 200);
    }

    // Tampilkan 1 Data
    public function show($id)
    {
        $province = Province::find($id);
        if (!$province) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($province, 200);
    }

    // Tambah Data
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $province = Province::create($request->all());
        return response()->json($province, 201);
    }

    // Update Data
    public function update(Request $request, $id)
    {
        $province = Province::find($id);
        if (!$province) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $province->update($request->all());
        return response()->json($province, 200);
    }

    // Hapus Data
    public function destroy($id)
    {
        $province = Province::find($id);
        if ($province) {
            $province->delete();
            return response()->json(['message' => 'Berhasil dihapus'], 200);
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
}