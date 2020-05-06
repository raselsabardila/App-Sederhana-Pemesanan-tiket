@extends('templates_backend.home')

@section("sub-title","Create Page")

@section('content')
    <form action="{{ route("tiket.store") }}" method="post">
        @csrf

        <div class="form-group">
            <label for="nama_tiket">Nama Tiket : </label>
            <input id="nama_tiket" class="form-control @error("nama_tiket") is-invalid @enderror" type="text" name="nama_tiket" minlength="3">
            @error("nama_tiket")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="jenis_tiket">Jenis Tiket : </label>
            <select name="jenis_tiket" class="form-control @error("jenis_tiket") is-invalid @enderror" id="">
                <option value="">Jenis Tiket</option>
                @foreach ($jenis as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            @error("jenis_tiket")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="kategori_tiket">Kategori Tiket : </label>
            <select name="kategori_tiket" class="form-control @error("kategori_tiket") is-invalid @enderror" id="">
                <option value="">Kategori Tiket</option>
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                @endforeach
            </select>
            @error("kategori_tiket")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="harga_tiket">Harga Tiket : </label>
            <input id="harga_tiket" class="form-control @error("harga_tiket") is-invalid @enderror" type="number" name="harga_tiket" min="0">
            @error("harga_tiket")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="jumlah_tiket">Jumlah Tiket : </label>
            <input id="jumlah_tiket" class="form-control @error("jumlah_tiket") is-invalid @enderror" type="number" name="jumlah_tiket" min="0">
            @error("jumlah_tiket")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block">Tambah Data</button>
    </form>
@endsection