@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <p><a href="{{ route('admin.adverts.categories.create') }}" class="btn btn-success">Add Category</a></p>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($categories as $category)
            <tr>
                <td>
                    @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                    <a href="{{ route('admin.adverts.categories.show', $category) }}">{{ $category->name }}</a>
                </td>
                <td>{{ $category->slug }}</td>
                <td>
                    <div class="d-flex flex-row">
                        <form method="POST" action="{{ route('admin.adverts.categories.first', $category) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-angle-double-up"></i></button>
                        </form>
                        <form method="POST" action="{{ route('admin.adverts.categories.up', $category) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-angle-up"></i></button>
                        </form>
                        <form method="POST" action="{{ route('admin.adverts.categories.down', $category) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-angle-down"></i></button>
                        </form>
                        <form method="POST" action="{{ route('admin.adverts.categories.last', $category) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-angle-double-down"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection 
