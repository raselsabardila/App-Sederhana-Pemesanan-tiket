<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable=["tiket_id","qty","status"];

    protected $table="transaksis";

    public function tiket(){
        return $this->belongsTo("App\Tiket","tiket_id");
    }
}
