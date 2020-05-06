@extends('templates_backend.home')

@section("sub-title","Edit Page")

@section('content')
    <form action="{{ route("kind.update",$kind) }}" method="post">
        @csrf
        @method("patch")

        <div class="form-group">
            <label for="nama">Nama : </label>
            <input id="nama" class="form-control @error("nama") is-invalid @enderror" type="text" name="nama" minlength="3" value="{{ $kind->nama }}">
            @error("nama")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">Tambah Data</button>
    </form>
@endsection