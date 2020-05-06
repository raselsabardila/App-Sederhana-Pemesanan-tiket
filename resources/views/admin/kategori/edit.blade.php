@extends('templates_backend.home')

@section("sub-title","Edit page")

@section('content')
    <form action="{{ route("category.update",$category) }}" method="post">
        @csrf
        @method("patch")
        <div class="form-group">
            <label for="nama_kategory">Nama Kategori : </label>
            <input type="text" name="nama_kategori" class="form-control @error("nama_kategori") is-invalid @enderror" minlength="3" value="{{ $category->nama_kategori }}">
            @error("nama_kategori")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary btn-block" type="submit">Edit Kategori</button>
    </form>
@endsection