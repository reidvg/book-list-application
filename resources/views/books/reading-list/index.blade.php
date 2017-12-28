@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>Add Books to {{$model->name}}</h1>
        @if(count($model->books) == 0)
            <p>Select the books using the checkboxes in the right hand column and hit <strong>'Save Book List'</strong> when you are happy with your selection.</p>
        @else
            <p><strong>Sweet!</strong> You can view your book list from <a href="/book-list/{{$model->id}}">here</a>, or the <a href="/">home page</a> if its public</p>
        @endif
        {!! Form::open(['method' => 'POST','route' => ['book-list.reading-list.store', $model->id]]) !!}
        @include('books.errors')
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save Book List</button>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>In List</th>
                <th>Image</th>
                <th>Title</th>
                <th>Owner</th>
                <th>Author</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>
                        {!! Form::hidden($book->id, 0) !!}
                        @if($book->in_list)
                            {!! Form::checkbox($book->id, 1, true) !!}
                        @else
                            {!! Form::checkbox($book->id, 1) !!}
                        @endif
                    </td>
                    <td>
                        @if($book->image)
                            <img src="/images/{{ $book->image }}"/>
                        @else
                            No Image
                        @endif
                    </td>
                    <td><a href="/book/{{ $book->id }}">{{ $book->title }}</a></td>
                    <td>{{ App\User::find($book->creator_id)->name }}</td>
                    <td>{{ $book->author }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! Form::close() !!}
    </div>
@endsection
