@extends('template')

@section('content')
    <h1>Edit Post: {{ $post->title }}</h1>

    @if($errors->any())

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    @endif

    {{ Form::model($post, ['route'=>['admin.update', $post->id], 'method'=>'put']) }}

    @include('admin.posts._form')

    <div>
        {{ Form::label('tags', 'Tags:', ['class' => 'control-label']) }}
        {{ Form::textarea('tags', $post->tagList, ['class' => 'form-control']) }}
    </div>

    <div>
        {!! Form::submit('Save', null, ['class'=>'btn-primary']) !!}
    </div>

    {{ Form::close() }}

@endsection