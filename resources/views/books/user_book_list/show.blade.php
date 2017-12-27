@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h2>{{ $model->name }}</h2>
        @include('books.errors')
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Owner</th>
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
                        <td>{{ App\User::find($bookList->book->creator_id)->name }}</td>
                        <td>{{ $bookList->book->description }}</td>
                        <td>{{ $bookList->book->publication_date }}</td>
                        <td>
                            @if(Auth::check())
                                @if($bookList->book->creator_id == Auth::user()->id)
                                <a class="btn btn-warning" href="/book/{{ $bookList->book->id }}/edit">Edit Book</a>
                                @endif
                            @endif
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
            @if(Auth::check())
            <a class="btn btn-success" href="{{ route('book-list.reading-list.index', $model->id) }}">Modify Books List</a>
            @endif
        </div>
    </div>
@endsection