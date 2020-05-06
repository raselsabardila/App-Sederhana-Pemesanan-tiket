<?php

namespace App\Http\Controllers;

use App\Category;
use App\Imports\CategoryImport;
use Excel;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $category=Category::latest()->paginate(10);
        return view("admin.kategori.index",compact("category"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.kategori.create");
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
            "nama_kategori"=>"required"
        ]);

        Category::create($request->all());

        return redirect()->route("category.index")->with("status","Data Berhasil Ditambahkan!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("admin.kategori.edit",["category"=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "nama_kategori"=>"required"
        ]);

        $category->update([
            "nama_kategori"=>$request->nama_kategori
        ]);

        return redirect()->route("category.index")->with("status","Data Berhasil Di Update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route("category.index")->with("status","Data Berhasil Di Delete!!");
    }

    public function search(Request $request){
        $category=Category::where("nama_kategori",$request->keyword)->orWhere("nama_kategori","like","%".$request->keyword."%")->paginate(6);

        return view("admin.kategori.index",compact("category"));
    }

    public function import(){
        return view("admin.kategori.import");
    }

    public function excel(Request $request){
        $request->validate([
            "file"=>"required|mimes:xls,xlsx,ods"
        ]);

        if($request->file != null){
            $file=$request->file("file");
            Excel::import(new CategoryImport,$file);

            return redirect()->route("category.index")->with("status","Data Berhasil Di Upload");
        }
        return redirect()->route("category.index")->with("status","Data Gagal Di Upload");
    }
}
