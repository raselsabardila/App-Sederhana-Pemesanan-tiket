<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketsTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tikets_tabel', function (Blueprint $table) {
            $table->id();
            $table->string("nama_tiket");
            $table->integer("harga_tiket");
            $table->integer("jenis_id");
            $table->integer("kategori_id");
            $table->integer("jumlah_tiket");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tikets_tabel');
    }
}
