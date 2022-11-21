<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama',
    ];


    // relationals

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, "mahasiswa_matakuliah", "mkId", "mhsNim");
    }
}
