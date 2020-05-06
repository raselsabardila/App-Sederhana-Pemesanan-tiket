<?php

namespace App\Http\Controllers;

use App\Tiket;
use App\Kind;
use App\Category;
use Illuminate\Http\Request;

class TiketController extends Controller
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
        $tiket=Tiket::latest()->paginate(10);
        return view("admin.tiket.index",compact("tiket"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis=Kind::all();
        $kategori=Category::all();

        return view("admin.tiket.create",compact("jenis","kategori"));
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
            "nama_tiket"=>"required",
            "jenis_tiket"=>"required",
            "kategori_tiket"=>"required",
            "harga_tiket"=>"required",
            "jumlah_tiket"=>"required"
        ]);

        Tiket::create([
            "nama_tiket"=>$request->nama_tiket,
            "jenis_id"=>$request->jenis_tiket,
            "kategori_id"=>$request->kategori_tiket,
            "harga_tiket"=>$request->harga_tiket,
            "jumlah_tiket"=>$request->jumlah_tiket
        ]);

        return redirect()->route("tiket.index")->with("status","Data Berhasil Di Tambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function edit(Tiket $tiket)
    {
        
        $jenis=Kind::all();
        $kategori=Category::all();

        return view("admin.tiket.edit",["tiket"=>$tiket,"jenis"=>$jenis,"kategori"=>$kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tiket $tiket)
    {
        $request->validate([
            "nama_tiket"=>"required",
            "jenis_tiket"=>"required",
            "kategori_tiket"=>"required",
            "harga_tiket"=>"required",
            "jumlah_tiket"=>"required"
        ]);

        $tiket->update([
            "nama_tiket"=>$request->nama_tiket,
            "jenis_id"=>$request->jenis_tiket,
            "kategori_id"=>$request->kategori_tiket,
            "harga_tiket"=>$request->harga_tiket,
            "jumlah_tiket"=>$request->jumlah_tiket
        ]);

        return redirect()->route("tiket.index")->with("status","Data Berhasil Di Edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tiket $tiket)
    {
        $tiket->delete();

        return redirect()->route("tiket.index")->with("status","Data Berhasil Di Hapus");
    }

    public function search(Request $request){
        $tiket=Tiket::where("nama_tiket",$request->keyword)->orWhere("nama_tiket","like","%".$request->keyword."%")->paginate(10);

        return view("admin.tiket.index",compact("tiket"));
    }
}
