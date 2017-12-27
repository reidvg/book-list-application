@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h2>{{ $model->name }}</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Publication Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @if(count($model->bookList) > 0)
                @foreach($model->bookList as $bookList)
                    <tr>
                        <td><img src="/images/{{ $bookList->book->image }}"></td>
                        <td><a href="/book/{{ $bookList->book->id }}">{{ $bookList->book->title }}</a></td>
                        <td>{{ $bookList->book->author }}</td>
                        <td>{{ $bookList->book->description }}</td>
                        <td>{{ $bookList->book->publication_date }}</td>
                        <td>
                            <a class="btn btn-warning" href="/book/{{ $bookList->book->id }}/edit">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['book.destroy', $bookList->book->id], 'style'=> 'display: inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">There are no books in this reading list yet!</td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="text-right">
            <a class="btn btn-success" href="{{ route('book.create') }}">Add Books to List</a>
        </div>
    </div>
@endsection