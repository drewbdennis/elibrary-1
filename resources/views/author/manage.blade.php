@extends('app')

@section('title') Manage Authors @endsection

@section('content')
    <h3>Create new author</h3>
    {!! Form::open( [ 'route' => 'author.store' ] ) !!}
        <div class="form-group">
            <label for="name">Author Name</label>
            {!! Form::text('name','',[ 'class' => 'form-control' , 'id' => 'name' ]) !!}
        </div>
        <div class="form-group">
            <label for="born">Year of born</label>
            {!! Form::text('born','',[ 'class' => 'form-control' , 'id' => 'born' ]) !!}
        </div>
        <div class="form-group">
            <label for="dead">Year when died</label>
            {!! Form::text('dead','',[ 'class' => 'form-control' , 'id' => 'died' ]) !!}
        </div>

        {!! Form::input('submit','Save','',[ 'class' => 'btn btn-default' , 'Value' => 'Save' ]) !!}

    {!! Form::close() !!}
    <table class="table-striped table authors">
        @foreach($authors as $author)
            <tr>
                <td>{{ $author->name }}</td>
                <td>{{ $author->born }}</td>
                <td>{{ $author->dead }}</td>
                <td><a href="{{ route('author.edit',$author->id) }}">Edit</a></td>
                <td><a href="{{ route('author.destroy',$author->id) }}">Remove</a></td>
            </tr>
        @endforeach
    </table>
@endsection