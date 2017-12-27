@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>Create new Book</h1>
        @include('books.errors')
        {!! Form::open(['method' => 'POST','route' => ['book.store'], 'enctype' => 'multipart/form-data']) !!}
        @include('books.book.form')
        {!! Form::close() !!}
    </div>
@endsection