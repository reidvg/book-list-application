@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>My Book Lists</h1>
        @include('books.errors')
        @include('books.my_book_lists')
        <div class="text-right">
            <a class="btn btn-success" href="/book-list/create">Create New Book List</a>
        </div>
    </div>
@endsection