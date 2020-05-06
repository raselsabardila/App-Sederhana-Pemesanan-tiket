<?php

namespace App\Http\Controllers;

use App\Kind;
use Illuminate\Http\Request;

class KindController extends Controller
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
        $kind=Kind::latest()->paginate(10);
        return view("admin.kind.index",compact("kind"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.kind.create");
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
            "nama"=>"required"
        ]);

        Kind::create($request->all());

        return redirect()->route("kind.index")->with("status","Data Berhasil Di Tambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function show(Kind $kind)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function edit(Kind $kind)
    {
        return view("admin.kind.edit",["kind"=>$kind]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kind $kind)
    {
        $request->validate(["nama"=>"required"]);

        $kind->update([
            "nama"=>$request->nama
        ]);

        return redirect()->route("kind.index")->with("status","Data Berhasil Di Edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kind  $kind
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kind $kind)
    {
        $kind->delete();

        return redirect()->route("kind.index")->with("status","Data Berhasil Di Hapus");
    }

    public function search(Request $request){
        $kind=Kind::where("nama",$request->keyword)->orWhere("nama","like","%".$request->keyword."%")->paginate(10);

        return view("admin.kind.index",compact("kind"));
    }
}
