<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('hospitals')->insert([
            [
                'nama_rumah_sakit' => 'RS ABC',
                'alamat' => 'Jl. Contoh No. 1',
                'email' => 'contact@rsabc.com',
                'telepon' => '021-12345678',
            ],
            [
                'nama_rumah_sakit' => 'RS DEF',
                'alamat' => 'Jl. Contoh No. 2',
                'email' => 'contact@rsdef.com',
                'telepon' => '021-87654321',
            ],
        ]);
    }
}

