@extends('templates_backend.home')

@section('sub-title','Tiket Page')

@section('content')

    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <form action="{{ route("tiket.search") }}" class="form-inline my-2 my-lg-0" method="POST">
        @csrf
        <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <br>
    <table class="table table-hover table-responsive">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nama Tiket</th>
                <th>Jenis Tiket</th>
                <th>Kategori Tiket</th>
                <th>Harga Tiket</th>
                <th>Jumlah Tiket</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tiket as $item => $hasil)
                <tr>
                    <td>{{ $item+$tiket->firstitem() }}</td>
                    <td>{{ $hasil->nama_tiket }}</td>
                    <td>{{ $hasil->jenis->nama }}</td>
                    <td>{{ $hasil->kategori->nama_kategori }}</td>
                    <td>Rp.{{ number_format($hasil->harga_tiket) }}</td>
                    <td>{{ $hasil->jumlah_tiket }}</td>
                    <td>
                        <form action="{{ route("tiket.destroy",$hasil) }}" method="POST">
                            <a href="{{ route("tiket.edit",$hasil) }}"><button class="btn btn-warning" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tiket->links() }}
@endsection