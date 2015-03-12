@extends('app')

@section('title') Manage Books @endsection

@section('content')
    <div class="clearfix"></div>
    <h3>Create new book</h3>
    {!! Form::open( [ 'route' => 'book.store' ] ) !!}

        <div class="form-group">
            <label for="title">Book Title</label>
            {!! Form::text('title','',[ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            {!! Form::textarea('content','',[ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            {!! Form::text('isbn','',[ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group">
            <label for="number">Copies</label>
            {!! Form::input('number','copies','',[ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group">
            <label for="author_id">Author</label>
            {!! Form::select('author_id',$authors,'',[ 'class' => 'form-control' ]) !!}
        </div>

        {!! Form::input('submit','Save','',[ 'class' => 'btn btn-default' , 'Value' => 'Save' ]) !!}

    {!! Form::close() !!}

    <table class="books table table-striped">
        <tr>
            <td>Title</td>
            <td>Author</td>
            <td>Readers</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author->name }}</td>
            <td>{{ $book->reading()->count() }}</td>
            <td class="danger"><a href="{{ route('book.edit',$book->id) }}">Edit</a></td>
            <td class="danger"><a class="delete_book" href="{{ route('book.delete',$book->id) }}">Delete</a></td>
        </tr>
        @endforeach
    </table>
@endsection