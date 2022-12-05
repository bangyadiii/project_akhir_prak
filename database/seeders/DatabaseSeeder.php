<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Prodi;
use Database\Factories\MatakuliahFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MatakuliahSeeder::class,
            ProdiSeeder::class,
        ]);

        //     $this->call([
        //         MatakuliahSeeder::class,
        //         ProdiSeeder::class,
        //     ]);

        //     $mahasiswas = Mahasiswa::factory()
        //         ->count(100)
        //         ->create();
    }
}
