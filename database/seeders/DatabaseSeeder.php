<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RumahSakitModel;
use App\Models\DataPasienModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "User {$i}",
                'username' => "testuser{$i}",
                'email' => "emailtester{$i}@test.com",
                'password' => Hash::make('password'), 
            ]);
        }

        $rsList = [];
        for ($i = 1; $i <= 5; $i++) {
            $rsList[] = RumahSakitModel::create([
                'nama_rumah_sakit' => "RS Dummy {$i}",
                'alamat' => "Alamat RS {$i}",
                'email' => "rs{$i}@mail.com",
                'nomor_telepon' => "02112345{$i}",
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            DataPasienModel::create([
                'nama_pasien' => "Pasien {$i}",
                'alamat' => "Alamat Pasien {$i}",
                'nomor_telepon' => "082182773652",
                'rs_id' => $rsList[array_rand($rsList)]->id, 
            ]);
        }
    }
}
