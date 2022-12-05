<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        $mahasiswa = Mahasiswa::with('prodi', "matakuliah")->get();

        return \response()->json([
            "success" => true,
            "message" => "grabbed all mahasiswa",
            "mahasiswa" => $mahasiswa
        ], 200);
    }

    public function getProfile(Request $request)
    {
        $mahasiswa = $request->mahasiswa;

        return response()->json([
            'success' => true,
            'message' => 'grabbed mahasiswa by token',
            'mahasiswa' =>  $mahasiswa->makeHidden("token")
        ], 200);
    }

    public function getMahasiswaByNIM(Request $request)
    {
        $mahasiswa = Mahasiswa::with('prodi', 'matakuliah')->find($request->nim);
        return response()->json([
            'success' => true,
            'message' => 'All post grabbed',
            'mahasiswa' => $mahasiswa
        ], 200);
    }

    public function tambahMatakuliah($nim, $mkId)
    {
        $mhs = Mahasiswa::findOrFail($nim);
        $mk = Matakuliah::findOrFail($mkId);

        $mhs->matakuliah()->attach($mk->id);

        return \response()->json([
            "success" => true,
            "message" => "Matakuliah added to mahasiswa"
        ]);
    }

    public function deleteMatakuliah($nim, $mkId)
    {
        $mhs = Mahasiswa::findOrFail($nim);
        $mk = Matakuliah::findOrFail($mkId);

        $mhs->matakuliah()->detach($mk->id);

        return \response()->json([
            "success" => true,
            "message" => "Matakuliah deleted to mahasiswa"
        ]);
    }
}
