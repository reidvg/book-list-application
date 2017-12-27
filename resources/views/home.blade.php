@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Book Lists</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/user-book-list">Go to My Book Lists</a>
                    @include('books.my_book_lists')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
