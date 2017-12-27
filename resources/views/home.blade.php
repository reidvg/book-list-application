@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><h3>Welcome to my Book List Application {{Auth::user()->name}}!</h3></div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>The structure is based on creating a book then adding it to one of your book lists. You may
                        specify whether the book or the book list is public or not. If it is public it will allow
                        the book to be added to your list. And if the book list is public it will be appear on the
                        <a href="/">front page.</a></p>
                    <hr>
                    <h4>To Begin, you should create a book <a href="/book/create">here.</a></h4>
                    <p>After you add a book to your collection you can then add it to a book list. If your set your book
                        to not be public, it will no longer display in other users' book lists, but you will still be
                        able to see it wherever it is.</p>
                    <hr>
                    <h4>Or you can create a book list <a href="/book-list/create">here</a></h4>
                    <p>Even if you have not added a book to your collection yet, you can start adding one of the
                        publicly available books</p>
                    <hr>
                </div>
                <div class="container-fluid">
                    <h4>Your Book Lists will appear below or you can use the menu navigation to go to 'My Book
                        Lists'</h4>
                    <hr>
                    <?php $book_lists = App\UserBookList::where(['user_id' => Auth::user()->id])->get() ?>
                    @include('books.my_book_lists')
                </div>
            </div>
        </div>
    </div>
@endsection
