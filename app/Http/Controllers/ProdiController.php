<?php

namespace App\Http\Controllers;

use App\Models\Prodi;

class ProdiController extends Controller
{

    public function index()
    {
        $prodi = Prodi::all();
        return \response()->json([
            "success" => true,
            "message" => "Get all prodi",
            "prodi" => $prodi
        ], 200);
    }
}
