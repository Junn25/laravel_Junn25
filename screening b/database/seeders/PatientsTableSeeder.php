<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('patients')->insert([
            [
                'nama_pasien' => 'John Doe',
                'alamat' => 'Jl. Pasien No. 1',
                'telepon' => '081-23456789',
                'id_rumah_sakit' => 1, 
            ],
            [
                'nama_pasien' => 'Jane Smith',
                'alamat' => 'Jl. Pasien No. 2',
                'telepon' => '081-98765432',
                'id_rumah_sakit' => 2, 
            ],
        ]);
    }
}

