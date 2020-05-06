<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tiket</th>
            <th>Qty</th>
            <th>Harga Tiket</th>
            <th>Subtotal</th>
        </tr>
    </thead>
        <tbody>
            @foreach ($transaksi as $item)
            <tr>
                <td>{!! $range+=1 !!}</td>
                <td>{!! $item->tiket->nama_tiket !!}</td>
                <td>{!! $item->qty !!}</td>
                <td>Rp.{!! number_format($item->tiket->harga_tiket) !!}</td>
                <td>Rp.{!! number_format($item->tiket->harga_tiket*$item->qty) !!}</td>
            </tr>
            <?php $total+=$item->tiket->harga_tiket*$item->qty ?>
            @endforeach
            <tr>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="3">Total : Rp.{!! number_format($total) !!}</td>
            </tr>
        </tbody>
</table>
