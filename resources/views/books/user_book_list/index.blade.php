@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>User Reading Lists</h1>
        @include('books.errors')
        @include('books.my_book_lists')
    </div>
@endsection