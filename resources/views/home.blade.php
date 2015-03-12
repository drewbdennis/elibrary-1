@extends('app')

@section('title') Home @endsection

@section('content')
        <div class="panel-body">
            Welcome : {{ Auth::user()->name }}
        </div>
        <div class="panel-body">
            <div class="col-md-3">
                <h4>Latest books at our library</h4>
            </div>
            <div class="col-md-9">
                @if(count($latestBooks))
                    <ul class="list-group">
                        @foreach ($latestBooks as $book)
                            <li class="list-group-item"><a href="{{ route("book.show",$book->id) }}">{{ $book->title }}</a></li>
                        @endforeach
                    </ul>
                @else
                    There are no books at our library
                @endif
            </div>
        </div>

        <div class="panel-body">
            <div class="col-md-3">
                <h4>You're currently reading</h4>
            </div>
            <div class="col-md-9">
                @if(count($reading))
                    <ul class="list-group">
                        @foreach ($reading as $book)
                            <li class="list-group-item"><a href="{{ route("book.show",$book->id) }}">{{ $book->title }}</a></li>
                        @endforeach
                    </ul>
                @else
                    You're not reading anything at all right now
                @endif
            </div>
        </div>

        <div class="panel-body">
            <div class="col-md-3">
                <h4>Popular Authors : </h4>
            </div>
            <div class="col-md-9">
                @if(count($popular_authors))
                    <ul class="list-group">
                        @foreach ($popular_authors as $author)
                            <li class="list-group-item"><a href="#">{{ $author->name }}</a></li>
                        @endforeach
                    </ul>
                @else
                    We don't have it yet
                @endif
            </div>
        </div>
@endsection
