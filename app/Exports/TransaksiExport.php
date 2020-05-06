<?php

namespace App\Exports;

use App\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TransaksiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function view():View
    {
        return view("admin.transaksi.eksel",["transaksi"=>Transaksi::all(),"range"=>0,"total"=>0]);
    }
}
