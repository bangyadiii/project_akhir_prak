<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodi = [
            ["nama" => "Teknologi Informasi"],
            ["nama" => "Sistem Informasi"],
            ["nama" => "Pendidikan Teknologi Informasi"],
            ["nama" => "Teknik Informatika"],
            ["nama" => "Teknik Komputer"],
        ];

        Prodi::factory()->createMany($prodi);
    }
}
