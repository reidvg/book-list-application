@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>Add Books to {{$model->name}}</h1>
        {!! Form::open(['method' => 'POST','route' => ['book-list.reading-list.store', $model->id]]) !!}
        @include('books.errors')
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save Book List</button>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>In List</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>
                        {!! Form::hidden($book->id, 0) !!}
                        @if($book->in_list)
                            {!! Form::checkbox($book->id, 1, true) !!}
                        @else
                            {!! Form::checkbox($book->id, 1) !!}
                        @endif
                    </td>
                    <td><img src="/images/{{ $book->image }}"/></td>
                    <td><a href="/book/{{ $book->id }}">{{ $book->title }}</a></td>
                    <td>{{ $book->publication_date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! Form::close() !!}
    </div>
@endsection
