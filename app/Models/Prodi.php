<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
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
        return $this->hasMany(Mahasiswa::class, "nim");
    }
}
