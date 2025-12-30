<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KinerjaController extends Controller
{
    // main function untuk cek predikat kinerja
    public function cekPredikat(Request $request)
    {
        // 1. ambil input dari req
        $hasil_kerja = $request->input('hasil_kerja');
        $perilaku = $request->input('perilaku');

        // 2. Validasi input
        if (!$hasil_kerja || !$perilaku) {
            return response()->json([
                'error' => 'Mohon isi parameter hasil_kerja dan perilaku'
            ], 400);
        }

        // 3. hitung predikat kinerja
        $predikat = $this->predikat_kinerja($hasil_kerja, $perilaku);

        // 4. hasil respons
        return response()->json([
            'hasil_kerja' => $hasil_kerja,
            'perilaku' => $perilaku,
            'predikat' => $predikat
        ]);
    }

    // function logika predikat kinerja
    private function predikat_kinerja($hasil_kerja, $perilaku)
    {
        // normalisasi input k lowercase
        $h = strtolower($hasil_kerja);
        $p = strtolower($perilaku);

        // baris 1 : hasil kerja diatas ekspektasi
        if ($h == 'diatas ekspektasi') {
            if ($p == 'diatas ekspektasi') {
                return 'Sangat Baik'; // Kotak Merah
            } elseif ($p == 'sesuai ekspektasi') {
                return 'Baik'; // Kotak Oranye
            } elseif ($p == 'dibawah ekspektasi') {
                return 'Kurang/misconduct'; // Kotak Hijau Muda
            }
        }
        
        // baris 2: hasil kerja sesuai ekspektasi
        elseif ($h == 'sesuai ekspektasi') {
            if ($p == 'diatas ekspektasi') {
                return 'Baik'; // Kotak Oranye
            } elseif ($p == 'sesuai ekspektasi') {
                return 'Baik'; // Kotak Oranye
            } elseif ($p == 'dibawah ekspektasi') {
                return 'Kurang/misconduct'; // Kotak Hijau Muda
            }
        }

        
        elseif ($h == 'dibawah ekspektasi') {
            if ($p == 'diatas ekspektasi') {
                return 'Butuh perbaikan'; // Kotak Kuning
            } elseif ($p == 'sesuai ekspektasi') {
                return 'Butuh perbaikan'; // Kotak Kuning
            } elseif ($p == 'dibawah ekspektasi') {
                return 'Sangat Kurang'; // Kotak Abu-abu
            }
        }

        
        return 'Input tidak valid (Periksa ejaan kembali)';
    }
}