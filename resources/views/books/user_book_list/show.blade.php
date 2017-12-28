@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h2>{{ $model->name }}</h2>
        <p>You can drag the table rows to your preferred order.</p>
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
                    <th></th>
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
                        <td>
                            @if(Auth::check())
                                @if($book->creator_id == Auth::user()->id)
                                <a class="btn btn-warning" href="/book/{{ $book->id }}/edit">Edit Book</a>
                                @endif
                                <i class="fa fa-2x fa-arrows text-right" style="position: absolute; right: 5%;"></i>
                            @endif
                        </td>
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
            <a class="btn btn-success" href="{{ route('book-list.reading-list.index', $model->id) }}">Modify Books List</a>
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
                update: function(e, ui) {
                    var data = $(this).sortable('serialize') + "&list_id=" + $(this).attr('data-attr');
                    $.ajax({
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '/book-order'
                    })
                }
            });
        </script>
    @endsection
@endif