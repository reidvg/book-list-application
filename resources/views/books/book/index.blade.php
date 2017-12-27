@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>My Books</h1>
        @include('books.errors')
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Public</th>
                <th>Description</th>
                <th>Publication Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($model as $book)
                    <tr>
                        <td>
                            @if($book->image)
                            <img src="images/{{ $book->image }}"/>
                            @else
                            No Image
                            @endif
                        </td>
                        <td><a href="/book/{{ $book->id }}">{{ $book->title }}</a></td>
                        <td>{{ $book->author }}</td>
                        <td>{{ ($book->public) ? 'Yes' : 'No' }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->publication_date }}</td>
                        <td><a class="btn btn-warning" href="/book/{{ $book->id }}/edit">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['book.destroy', $book->id], 'style'=> 'display: inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <a class="btn btn-success" href="/book/create">Create New Book</a>
        </div>
    </div>
@endsection
