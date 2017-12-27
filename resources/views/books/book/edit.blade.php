@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>Edit {{ $model->title }}</h1>
        @include('books.errors')
        {!! Form::model($model, ['method' => 'PUT','route' => ['book.update', $model->id], 'enctype' => 'multipart/form-data']) !!}
        @include('books.book.form')
        {!! Form::close() !!}
    </div>
@endsection