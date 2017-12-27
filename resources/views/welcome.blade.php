@extends('layouts.public')
@section('content')
    <div class="container-fluid">

        <div class="col-md-6 col-md-offset-3">
            <div class="title m-b-md">
                <h1>All Book Lists</h1>
                <p>Welcome to my book list application! Here you can see all public book lists.</p>
            </div>
            <div class="position-ref full-height">
                <div class="">
                    @include('books.public_book_lists')
                </div>
            </div>
        </div>
    </div>
@endsection
