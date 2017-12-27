@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2>{{ $model->name }}</h2>
        <h3>Books in List:</h3>
        <table class="table table-striped">
            <thead>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Image</th>
                <th>Publication Date</th>
            </thead>
            <tbody>
                @foreach($model->bookList as $bookList)
                    <tr>
                        <td>{{ $bookList->book->title }}</td>
                        <td>{{ $bookList->book->author }}</td>
                        <td>{{ $bookList->book->description }}</td>
                        <td>{{ $bookList->book->image }}</td>
                        <td>{{ $bookList->book->publication_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection