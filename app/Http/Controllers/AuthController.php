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
    protected function jwt(Mahasiswa $user)
    {
        $payload = [
        'iss' => 'lumen-jwt', //issuer of the token
        'sub' => $user->id, //subject of the token
        'iat' => time(), //time when JWT was issued.
        'exp' => time() + 60 * 60 //time when JWT will expire
        ];

        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public function login(Request $request)
    {
        $nim = $request->nim;
        $password = $request->password;

        $user = Mahasiswa::where('nim', $nim)->first();

        if (!$user) {
        return response()->json([
            'status' => 'Error',
            'message' => 'user not exist',
        ], 404);
        }

        if (!Hash::check($password, $user->password)) {
        return response()->json([
            'status' => 'Error',
            'message' => 'wrong password',
        ], 400);
        }

        $user->token = $this->jwt($user); //
        $user->save();

        return response()->json([
        'status' => 'Success',
        'message' => 'successfully login',
        'data' => [
            'user' => $user,
        ]
        ], 200);
    }


    //
    public function register(Request $request)
    {
        $nama = $request->nama;
        $nim = $request->nim;
        $angkatan = $request->angkatan;
        $prodi_id = $request->prodi_id;
        $password = Hash::make($request->password);

        $user = Mahasiswa::create([
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'prodi_id' => $prodi_id,
            'password' => $password
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'new user created',
            'data' => [
                'user' => $user,
            ]
        ],200);
    }
    private function base64url_encode(String $data): String
    {
        $base64 = base64_encode($data); // ubah json string menjadi base64
        $base64url = strtr($base64, '+/', '-_'); // ubah char '+' -> '-' dan '/' -> '_'

        return rtrim($base64url, '='); // menghilangkan '=' pada akhir string
    }

    private function sign(String $header, String $payload, String $secret): String
    {
        $signature = hash_hmac('sha256', "{$header}.{$payload}", $secret, true);
        $signature_base64url = $this->base64url_encode($signature);

        return $signature_base64url;
    }

   
}