@extends('app')

@section('title') Edit Book : {{ $book->title }} @endsection

@section('content')

    {!! Form::model($book,[ 'route' => ['book.update',$book->id] ]) !!}
        <div class="form-group">
            <label for="title">Book Title</label>
            {!! Form::text('title',$book->title,[ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group">
            <label for="title">Content</label>
            {!! Form::textarea('content',$book->content,[ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group">
            <label for="title">ISBN</label>
            {!! Form::text('isbn',$book->isbn,[ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group">
            <label for="title">Copies</label>
            {!! Form::input('number','copies',$book->copies,[ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group">
            <label for="title">Author</label>
            {!! Form::select('author_id',$authors,$book->author_id,[ 'class' => 'form-control' ]) !!}
        </div>

        {!! Form::input('submit','Update','',[ 'class' => 'btn btn-default' , 'Value' => 'Update' ]) !!}
    {!! Form::close() !!}
@endsection