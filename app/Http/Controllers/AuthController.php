<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) //
    {
        //

        $this->request = $request;
    }
    protected function jwt(Mahasiswa $mahasiswa)
    {
        $payload = [
            'iss' => 'lumen-jwt', //issuer of the token
            'sub' => $mahasiswa->nim, //subject of the token
            'iat' => time(), //time when JWT was issued.
            'exp' => time() + 60 * 60 //time when JWT will expire
        ];

        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public function login(Request $request)
    {
        $nim = $request->nim;
        $password = $request->password;
        $mahasiswa = Mahasiswa::find($nim);

        if (!$mahasiswa) {
            return response()->json([
                'status' => false,
                'message' => 'mahasiswa not exist',
            ], 404);
        }

        if (!Hash::check($password, $mahasiswa->password)) {
            return response()->json([
                'status' => false,
                'message' => 'wrong password',
            ], 400);
        }

        $mahasiswa->token = $this->jwt($mahasiswa); //
        $mahasiswa->saveOrFail();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged in',
            'token' => $mahasiswa->token,
        ], 200);
    }


    public function register(Request $request)
    {
        $nama = $request->nama;
        $nim = $request->nim;
        $angkatan = $request->angkatan;
        $prodiId = $request->prodiId;
        $password = Hash::make($request->password);

        $mahasiswa = Mahasiswa::create([
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'prodi_id' => $prodiId,
            'password' => $password
        ]);

        return response()->json([
            'success' => true,
            'message' => 'new mahasiswa created',
            'data' => [
                'mahasiswa' => $mahasiswa,
            ]
        ], 200);
    }
}
