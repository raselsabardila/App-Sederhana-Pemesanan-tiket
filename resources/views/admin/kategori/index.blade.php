@extends('templates_backend.home')

@section("sub-title","category page")

@section('content')

    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{ session("status") }}
        </div>
    @endif

    <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route("category.search") }}">
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
            @foreach ($category as $item => $hasil)
                <tr>
                    <td>{{ $item+$category->firstitem() }}</td>
                    <td>{{ $hasil->nama_kategori }}</td>
                    <td>
                        <form action="{{ route("category.destroy",$hasil) }}" method="post">
                            <a href="{{ route("category.edit",$hasil) }}"><button class="btn btn-warning" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    {{ $category->links() }}
@endsection