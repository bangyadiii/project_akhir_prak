<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return \response()->json($mahasiswa, 200);
    }

    public function getProfile(Request $request)
    {
        $mahasiswa = $request->mahasiswa;
        $mahasiswa = Mahasiswa::find($mahasiswa->nim);
        return response()->json([
            'success' => true,
            'message' => 'All post grabbed',
            'data' => [
            'mahasiswa' => [
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'angkatan' => $mahasiswa->angkatan,
                'prodi_id' => $mahasiswa->prodi_id,
                'created_at' => $mahasiswa->created_at,
                'updated_at' => $mahasiswa->updated_at,
                'token' => $mahasiswa->token,
            ]
        ]
        ], 200);
    }

    public function getMahasiswaByNIM(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->nim);
        return response()->json([
            'success' => true,
            'message' => 'All post grabbed',
            'data' => [
            'mahasiswa' => [
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'angkatan' => $mahasiswa->angkatan,
                'prodi_id' => $mahasiswa->prodi_id,
                'created_at' => $mahasiswa->created_at,
                'updated_at' => $mahasiswa->updated_at,
                'token' => $mahasiswa->token,
            ]
        ]
        ], 200);
    }

    
}

