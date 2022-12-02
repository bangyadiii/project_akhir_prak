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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']); // route login
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']);
});

$router->get("/prodi", "ProdiController@index");
$router->get("/matakuliah", "MatakuliahController@index");

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/', ['uses' => 'MahasiswaController@index']);
    $router->get('/profile', ['middleware' => 'jwt.auth','uses' => 'MahasiswaController@getProfile']);
    $router->get('/{nim}', ['uses' => 'MahasiswaController@getMahasiswaByNIM']);
});
