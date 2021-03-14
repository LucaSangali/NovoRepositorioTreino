@extends('template')

@section('content')
    <h1>Blog Admin</h1>

    <a href="{{ route('admin.create') }}"><button type="button" class="btn btn-success">Create new Post</button></a>
    <br>
    <br>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Action</th>
        </tr>

        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>
                <a href="{{ route('admin.edit', ['id'=> $post->id]) }}"><button type="button" class="btn btn-warning">Edit</button></a>
                <a href="{{ route('admin.destroy', ['id'=> $post->id]) }}"><button type="button" class="btn btn-danger">Destroy</button></a>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $posts->render() }}

@endsection