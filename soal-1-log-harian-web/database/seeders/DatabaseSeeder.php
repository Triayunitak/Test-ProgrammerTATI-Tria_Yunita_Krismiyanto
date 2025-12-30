<?php
    namespace Database\Seeders;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Enkripsi password 'password' agar bisa dipakai Login
        $password = Hash::make('password'); 
        $now = now();

        DB::table('users')->insert([
            // 1. Kepala Dinas
            ['id_user' => 1, 'user_name' => 'Kepala Dinas', 'email_user' => 'kadis@example.com', 'user_password' => $password, 'role' => 'kepala_dinas', 'supervisor_id' => null, 'created_at' => $now, 'updated_at' => $now],
            
            // 2. Kepala Bidang (Atasan: Kadis)
            ['id_user' => 2, 'user_name' => 'Kepala Bidang 1', 'email_user' => 'kabid1@example.com', 'user_password' => $password, 'role' => 'kepala_bidang', 'supervisor_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id_user' => 3, 'user_name' => 'Kepala Bidang 2', 'email_user' => 'kabid2@example.com', 'user_password' => $password, 'role' => 'kepala_bidang', 'supervisor_id' => 1, 'created_at' => $now, 'updated_at' => $now],

            // 3. Staff (Atasan: Kabid)
            ['id_user' => 4, 'user_name' => 'Staff 1', 'email_user' => 'staff1@example.com', 'user_password' => $password, 'role' => 'staff', 'supervisor_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id_user' => 5, 'user_name' => 'Staff 2', 'email_user' => 'staff2@example.com', 'user_password' => $password, 'role' => 'staff', 'supervisor_id' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
