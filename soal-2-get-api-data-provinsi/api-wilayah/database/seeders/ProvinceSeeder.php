<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil data dari wilayah.id
        $response = Http::get('https://wilayah.id/api/provinces.json');
        
        // 2. Ambil bagian 'data'-nya saja
        // Karena struktur JSON-nya { "data": [ ... ], "meta": ... }
        $provinces = $response->json()['data']; 

        // 3. Masukkan ke database lokal
        foreach ($provinces as $province) {
            Province::create([
                // Di wilayah.id kuncinya 'name', sama seperti database kita
                'name' => $province['name']
            ]);
        }
    }
}