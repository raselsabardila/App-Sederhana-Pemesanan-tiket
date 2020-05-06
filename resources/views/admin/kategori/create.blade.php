@extends('templates_backend.home')

@section("sub-title","create page")

@section('content')
    <form action="{{ route("category.store") }}" method="post">
        @csrf

        <div class="form-group">
            <label for="nama_kategory">Nama Kategori : </label>
            <input type="text" name="nama_kategori" class="form-control @error("nama_kategori") is-invalid @enderror" minlength="3">
            @error("nama_kategori")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary btn-block" type="submit">Tambah Kategori</button>
    </form>
@endsection