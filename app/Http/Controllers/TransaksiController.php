<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Tiket;
use Fpdf;
use Illuminate\Http\Request;
use App\Exports\TransaksiExport;

class TransaksiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi=Transaksi::where("status",0)->get();
        $tiket=Tiket::all();
        $range=0;
        $total=0;
        return view("admin.transaksi.index",compact("transaksi","tiket","range","total"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "tiket_id"=>"required",
            "qty"=>"required"
        ]);

        $tiket=Tiket::find($request->tiket_id);
        if($request->qty > $tiket->jumlah_tiket){
            return redirect()->route("transaksi.index")->with('status',"Jumlah Qty Melebihi Jumlah Tiket Tersedia(Jumlah Tiket : $tiket->jumlah_tiket )");
        }

        Transaksi::create($request->all());

            $tiket->update([
                "jumlah_tiket"=>$tiket->jumlah_tiket-$request->qty
            ]);

        return redirect()->route("transaksi.index")->with('status',"Transaksi Berhasil Di Tambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $tiket=Tiket::find($transaksi->tiket_id);
        $tiket->update(["jumlah_tiket"=>$tiket->jumlah_tiket+$transaksi->qty]);
        $transaksi->delete();
        return redirect()->route("transaksi.index")->with('status',"Transaksi Berhasil Di Cencel");
    }

    public function selesai(){
        $transaksi=Transaksi::where("status",0);
        $transaksi->update([
            "status"=>1
        ]);

        return redirect()->route("transaksi.index")->with("status","Data Telah Di Selesaikan");
    }

    public function laporan(){
        $pdf = new Fpdf("L","cm","A4");
        $pdf::AddPage();
        $pdf::SetFont('Arial', 'B', 18);
        $pdf::Cell(185,7,'Laporan Penjualan tiket',0,1,'C');
        $pdf::SetFont('Arial', '', 12);
        $pdf::Cell(185,5,'BOGOR',0,1,'C');
        $pdf::SetFont('Arial', '', 12);
        $pdf::Cell(185,5,"Telpon : 089638889862 ",0,1,'C');
        $pdf::Line(10,30,190,30);
        $pdf::Line(10,31,190,31);
        $pdf::Cell(30,10,'',0,1);
        $pdf::SetFont('Arial', 'B', 14);
        $pdf::Cell(185,5,'Penjualan Tiket',0,0,'C');
        $pdf::Cell(30,10,'',0,1);
        $pdf::Cell(60,7,'Nama Tiket',1,0);
        $pdf::Cell(25,7,'Qty',1,0);
        $pdf::Cell(40,7,'Harga Tiket',1,0);
        $pdf::Cell(38,7,'Subtotal',1,0);
        $pdf::Cell(30,7,'Tanggal',1,1);
        $transaksi=Transaksi::where('status',1)->get();
        foreach($transaksi as $item){
            $pdf::Cell(60,7,$item->tiket->nama_tiket,1,0);
            $pdf::Cell(25,7,$item->qty,1,0);
            $pdf::Cell(40,7,$item->tiket->harga_tiket,1,0);
            $pdf::Cell(38,7,$item->tiket->harga_tiket*$item->qty,1,0);
            $pdf::Cell(30,7,\Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %b %Y'),1,1);
        }

        $pdf::Output();
        exit;
    }

    public function excel(){
        return(new TransaksiExport)->download("penjualan_tiket"."."."xlsx");
    }
}
