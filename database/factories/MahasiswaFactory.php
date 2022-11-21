<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class MahasiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mahasiswa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nim' => (string) \rand(2002312300, 22023123123),
            'nama' => $this->faker->name,
            "prodi_id" => \rand(1, Prodi::count()),
            'angkatan' => \rand(2017, 2022),
            "password" => Hash::make("password1234"),
        ];
    }
}
