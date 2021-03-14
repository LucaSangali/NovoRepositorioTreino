@extends('template')

@section('content')
    <h1>Create new Post</h1>

    @if($errors->any())

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    @endif

    {{ Form::open(['route'=>'admin.store', 'method'=>'post']) }}

    @include('admin.posts._form')

    <div>
        {{ Form::label('tags', 'Tags:', ['class' => 'control-label']) }}
        {{ Form::textarea('tags', null, ['class' => 'form-control']) }}
    </div>

    <div>
        {!! Form::submit('Create post', null, ['class'=>'btn-primary']) !!}
    </div>

    {{ Form::close() }}

@endsection