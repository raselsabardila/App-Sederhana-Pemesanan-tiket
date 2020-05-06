@extends('templates_backend.home')

@section("sub-title","Import Page")

@section('content')
<form action="{{ route("category.excel") }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="nama_kategory">File Import : </label>
        <input type="file" name="file" class="form-control @error("file") is-invalid @enderror" minlength="3">
        @error("file")
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button class="btn btn-primary btn-block" type="submit">Import File</button>
</form>
@endsection