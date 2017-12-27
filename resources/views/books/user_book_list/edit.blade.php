@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>Edit {{ $model->name }}</h1>
        @include('books.errors')
        {!! Form::model($model, ['method' => 'PUT','route' => ['book-list.update', $model->id]]) !!}
        @include('books.user_book_list.form')
        {!! Form::close() !!}
    </div>
@endsection