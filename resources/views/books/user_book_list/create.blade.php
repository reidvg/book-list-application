@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>Create new Book List</h1>
        @include('books.errors')
        {!! Form::open(['method' => 'POST','route' => ['user-book-list.store']]) !!}
        @include('books.user_book_list.form')
        {!! Form::close() !!}
    </div>
@endsection