@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>My Book Lists</h1>
        @include('books.errors')
        @if(count($book_lists) > 0)
            @foreach($book_lists as $book_list)
                @if(count($book_list->books) > 0)
                    <p><strong>Awesome! Now you can look at your book list from your <a href="/home">home page</a>, or from the <a href="/">landing page.</a></strong></p>
                    @break
                @else
                    <p>Cool! <strong>Now you can add books to your list by clicking 'Modify List'</strong></p>
                    @break
                @endif
            @endforeach
        @else
            <p>Create a book list so you can add books to your list!</p>
        @endif
        @include('books.my_book_lists')
        <div class="text-right">
            <a class="btn btn-success" href="/book-list/create">Create New Book List</a>
        </div>
    </div>
@endsection