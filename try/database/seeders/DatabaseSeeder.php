<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Kepala Dinas (No Supervisor)
        $kadis = User::create([
            'user_name' => 'Dr. Budi Santoso',
            'email_user' => 'kadis@agency.com',
            'password' => Hash::make('password'),
            'role' => 'kepala_dinas',
            'supervisor_id' => null,
        ]);

        // 2. Kepala Bidang (Supervised by Kadis)
        $kabid1 = User::create([
            'user_name' => 'Siti Aminah, S.Kom',
            'email_user' => 'kabid.it@agency.com',
            'password' => Hash::make('password'),
            'role' => 'kepala_bidang',
            'supervisor_id' => $kadis->id_user,
        ]);

        // 3. Staff (Supervised by Kabid)
        $staff1 = User::create([
            'user_name' => 'Rizky Pratama',
            'email_user' => 'staff.rizky@agency.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'supervisor_id' => $kabid1->id_user,
        ]);

        $staff2 = User::create([
            'user_name' => 'Dewi Lestari',
            'email_user' => 'staff.dewi@agency.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'supervisor_id' => $kabid1->id_user,
        ]);
    }
}
