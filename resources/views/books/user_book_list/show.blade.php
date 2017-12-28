@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h2>{{ $model->name }} <span class="sortable-updated"></span></h2>
        @if(Auth::check() and Auth::user()->id == $model->user_id)
            @if(count($books) > 0)
                <p>Now that you have books in your list, you can drag them to your preferred order. Your book order will
                    save automatically.</p>
                @if($model->public)
                    <p>Since your book list is public, you can view it from the <a href="/">home page.</a></p>
                @else
                    <p>Your book list isn't public so you will be the only one able to see it. If you want it to display on
                        the landing page You can change your book list to public <a
                                href="{{ route('book-list.edit', $model->id) }}">here.</a>
                    </p>
                @endif
            @endif
        @endif
        <p>{{ $model->description }}</p>
        @include('books.errors')
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Owner</th>
                <th>Description</th>
                <th>Publication Date</th>
                @if(Auth::check())
                    <th></th>
                @endif
            </tr>
            </thead>
            <tbody class="sortable" data-attr="{{$model->id}}">
            @if(count($books) > 0)
                @foreach($books as $book)
                    <tr id="book_{{$book->id}}">
                        <td>
                            @if($book->image)
                                <img src="/images/{{ $book->image }}"/><span hidden>{{$book->image}}</span>
                            @else
                                No Image
                            @endif
                        </td>
                        <td><a href="/book/{{ $book->id }}">{{ $book->title }}</a></td>
                        <td>{{ $book->author }}</td>
                        <td>{{ App\User::find($book->creator_id)->name }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->publication_date }}</td>
                        @if(Auth::check())
                            <td>
                                @if($book->creator_id == Auth::user()->id)
                                    <a class="btn btn-warning" href="/book/{{ $book->id }}/edit">Edit Book</a>
                                @endif
                                @if($model->user_id == Auth::user()->id)
                                    <i class="fa fa-2x fa-arrows text-right" style="position: absolute; right: 5%;"></i>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">There are no books in this reading list yet!</td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="text-right">
            @if(Auth::check() and $model->user_id == Auth::user()->id)
                <p>You can drag the table rows to your preferred order.</p>
                <a class="btn btn-success" href="{{ route('book-list.reading-list.index', $model->id) }}">Modify Books
                    List</a>
            @endif
        </div>
    </div>
@endsection
@if(Auth::check() and $model->user_id == Auth::user()->id)
@section('js-specific')
    <script>
        $(".sortable").sortable({
            cursor: 'move',
            opacity: 0.6,
            update: function (e, ui) {
                $('.sortable-updated').html('<span"><i class="fa fa-spin fa-cog"></i></span>');
                var data = $(this).sortable('serialize') + "&list_id=" + $(this).attr('data-attr');
                $.ajax({
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/book-order',
                    success: function (e) {
                        $('.sortable-updated').html('<span class="success"><i class="fa fa-check"></i> Updated List Order.</span>')
                    },
                    error: function (e) {
                        $('.sortable-updated').html('<span class="error"><i class="fa fa-times"></i> Failed to Update List Order.</span>')
                    }
                })
            }
        });
    </script>
@endsection
@endif