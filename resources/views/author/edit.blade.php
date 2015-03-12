@extends('app')

@section('title') Edit author : {{ $author->name }} @endsection

@section('content')

    {!! Form::model($author,[ 'route' => ['author.update',$author->id] ]) !!}
        <div class="form-group">
            <label for="name">Author Name</label>
            {!! Form::text('name',$author->name,[ 'class' => 'form-control' , 'id' => 'name' ]) !!}
        </div>
        <div class="form-group">
            <label for="born">Year of born</label>
            {!! Form::text('born',$author->born,[ 'class' => 'form-control' , 'id' => 'born' ]) !!}
        </div>
        <div class="form-group">
            <label for="born">Year when died</label>
            {!! Form::text('dead',$author->dead,[ 'class' => 'form-control' , 'id' => 'died' ]) !!}
        </div>

        {!! Form::input('submit','Save','',[ 'class' => 'btn btn-default' , 'Value' => 'Save' ]) !!}
    {!! Form::close() !!}
@endsection