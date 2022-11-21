<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get("/", function () use ($router) {
    return app()->version();
});

$router->get('/mahasiswa/{nim}/matakuliah/{id}', function (Request $request, $nim, $id) use ($router) {
    $mahasiswa = Mahasiswa::find($nim);
    $mahasiswa->matakuliahs()->attach([$id]);
    return $mahasiswa->load('matakuliahs', "prodi");
});

$router->get('/post', function () use ($router) {
    $mahasiswa = Mahasiswa::create([
        "nim" => "10923810923",
        "nama" => "sdaaksd",
        "angkatan" => 2020,
        "password" => Hash::make("password"),
        "prodi_id" => 1,
    ]);

    return $mahasiswa;
});
