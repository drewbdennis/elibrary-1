@extends('app')

@section('title') Book : {{ $book->title }} @endsection

@section('content')
    <div class="single-book col-sm-12">
        <div class="page-header book-title">
          <h1>{{ $book->title }} <small> by : {{ $book->author->name }}</small></h1>
        </div>
            <p>
                {{ $book->content }}
            </p>
            @if(Auth::user()->isReading($book))
                <div class="alert alert-info">You are reading this book</div>
                {!! Form::open(['route'=>['book.return',$book->id]]) !!}
                    {!! Form::hidden('id',$book->id) !!}
                    <div class="form-group">
                        {!! Form::Submit("Return to library") !!}
                    </div>
                {!! Form::close() !!}
            @else
                <a href="{{ route("book.read",$book->id) }}">Read this book</a>
            @endif
    </div>
@endsection