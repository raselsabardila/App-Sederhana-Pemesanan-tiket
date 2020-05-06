<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $fillable=["nama_tiket","harga_tiket","kategori_id","jenis_id","jumlah_tiket"];

    protected $table="tikets_tabel";

    public function kategori(){
        return $this->belongsTo("App\Category","kategori_id");
    }

    public function jenis(){
        return $this->belongsTo("App\Kind","jenis_id");
    }
}
