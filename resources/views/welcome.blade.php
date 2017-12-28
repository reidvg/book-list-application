@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="col-md-10 col-md-offset-1">
            <div class="title m-b-md">
                <h1>All Book Lists</h1>
                @if (!Session::get('message'))
                    <h3>Welcome to my book list application! Here you can see all public book lists.</h3>
                    @if(!Auth::check())
                        <p>You can <a href="/register">register</a> or <a href="/login">login</a> to start creating your own book lists!</p>
                    @endif
                @else
                    <h3>{{ Session::get('message') }}</h3>
                @endif
            </div>
            <div class="position-ref full-height">
                <div class="">
                    @include('books.public_book_lists')
                </div>
            </div>
        </div>
    </div>
@endsection
