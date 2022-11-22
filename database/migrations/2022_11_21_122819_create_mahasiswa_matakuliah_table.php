<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->string("mhsNim");
            $table->foreignId("mkId")->constrained("matakuliahs", "id")->onDelete("cascade");
            $table->foreign("mhsNim")->references("nim")->on("mahasiswas")->onDelete("cascade");
            $table->primary(["mhsNim", "mkId"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa_matakuliah');
    }
};
