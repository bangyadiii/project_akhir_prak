<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Prodi;

class MatakuliahController extends Controller
{

    public function index()
    {
        $mk = Matakuliah::all();
        return \response()->json([
            "success" => true,
            "message" => "grabbed all mata kuliah",
            "matakuliah" => $mk
        ], 200);
    }
}
