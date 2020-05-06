<div class="main-sidebar">
    <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
            <a href="{{route("home")}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-list-ul" aria-hidden="true"></i> <span>Jenis Tiket</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('kind.index')}}">List Jenis Tiket</a></li>
                <li><a class="nav-link" href="{{route('kind.create')}}">Create Jenis Tiket</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-bookmark" aria-hidden="true"></i> <span>Category</span></a>
            <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('category.index')}}">List Category</a></li>
            <li><a class="nav-link" href="{{route('category.create')}}">Create Category</a></li>
            <li><a class="nav-link" href="{{route('category.import')}}">Import Category</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-ticket" aria-hidden="true"></i> <span>Tiket</span></a>
            <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('tiket.index')}}">List Tiket</a></li>
            <li><a class="nav-link" href="{{route('tiket.create')}}">Create Tiket</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Transaksi</span></a>
            <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('transaksi.index')}}">List Transaksi</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span>Laporan Penjualan</span></a>
            <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('transaksi.laporan')}}">Cetak Pdf</a></li>
            <li><a class="nav-link" href="{{route('transaksi.excel')}}">Cetak Excel</a></li>
            </ul>
        </li>
        </ul>
    </aside>
</div>