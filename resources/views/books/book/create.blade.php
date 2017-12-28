@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>Create new Book</h1>
        <p>This page is integrated with OpenLibrary to auto-populate some of the book information. To start, simply
            type a book you know into the title field. (Eg: Lord of the Rings) </p>
        <p class="text-muted">* Unfortunately publication date is typically not present for most API calls, or is only available in year format.</p>
        @include('books.errors')
        {!! Form::open(['method' => 'POST','route' => ['book.store'], 'enctype' => 'multipart/form-data']) !!}
        @include('books.book.form')
        {!! Form::close() !!}
    </div>
@endsection