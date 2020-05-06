@extends('templates_backend.home')

@section("sub-title","Transaksi Page")

@section('content')

    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <form action="" method="post">
        @csrf

        <div class="form-group">
            <label for="nama_tiket">Nama Tiket : </label>
            <select name="tiket_id" class="form-control" id="">
                <option value="">Pilih Tiket</option>
                @foreach ($tiket as $item)
                    @if ($item->jumlah_tiket > 0)
                        <option value="{{ $item->id }}">{{ $item->nama_tiket }}</option>
                    @endif
                @endforeach
            </select>
            @error("tiket_id")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="qty">QTY : </label>
            <input id="qty" class="form-control @error("qty") is-invalid @enderror" type="number" name="qty" min="1" max="">
            @error("qty")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <a href="{{ route("transaksi.store") }}"><button class="btn btn-primary btn-block" type="submit">Simpan</button></a>
        <a href="{{ route("transaksi.selesai") }}"><button class="btn btn-success btn-block mt-2" type="button">Selesai</button></a>
    </form>
    <br><br>

    <h4>Detail Transaksi</h4>
    <table class="table table-hover table-responsive">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nama Tiket</th>
                <th>Qty</th>
                <th>Harga Tiket</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $range+=1 }}</td>
                    <td>{{ $item->tiket->nama_tiket }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp.{{ number_format($item->tiket->harga_tiket) }}</td>
                    <td>Rp.{{ number_format($item->tiket->harga_tiket*$item->qty) }}</td>
                    <td>
                        <form action="{{ route("transaksi.destroy",$item) }}" method="post">
                            @csrf
                            @method("delete")

                            <button type="submit" class="btn btn-danger">Cencel</button>
                        </form>
                    </td>
                </tr>
                <?php $total+=$item->tiket->harga_tiket*$item->qty ?>
            @endforeach
        </tbody>
            <tfoot>
                <tr>
                    <th>
                        <td>Total : {{ number_format($total) }}</td>
                    </th>
                </tr>
            </tfoot>
    </table>
@endsection