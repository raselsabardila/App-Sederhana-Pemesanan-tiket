@extends('templates_backend.home')

@section("sub-title","Jenis Tiket Page")

@section('content')
    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route("kind.search") }}">
        @csrf
        <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <br>

    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kind as $item => $hasil)
                <tr>
                    <td>{{ $item+$kind->firstitem() }}</td>
                    <td>{{ $hasil->nama }}</td>
                    <td>
                        <form action="{{ route("kind.destroy",$hasil) }}" method="post">
                            <a href="{{ route("kind.edit",$hasil) }}"><button class="btn btn-warning" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $kind->links() }}
@endsection