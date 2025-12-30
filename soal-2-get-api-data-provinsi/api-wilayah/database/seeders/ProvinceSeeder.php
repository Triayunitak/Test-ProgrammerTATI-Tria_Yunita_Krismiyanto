<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        
        $response = Http::get('https://wilayah.id/api/provinces.json');
        
    
        $provinces = $response->json()['data']; 
        
        foreach ($provinces as $province) {
            Province::create([
                
                'name' => $province['name']
            ]);
        }
    }
}