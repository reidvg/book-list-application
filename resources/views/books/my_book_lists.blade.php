<?php
$book_lists = App\UserBookList::all();
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Public</th>
        <th>Updated Date</th>
        <th>Created Date</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($book_lists as $book_list)
        <tr>
            <td><a href="/user-book-list/{{ $book_list->id }}">{{ $book_list->name }}</a></td>
            <td>{{ $book_list->description }}</td>
            <td>{{ ($book_list->public) ? 'Yes' : 'No' }}</td>
            <td>{{ $book_list->updated_at }}</td>
            <td>{{ $book_list->created_at }}</td>
            <td>
                <a class="btn btn-warning" href="/user-book-list/{{ $book_list->id }}/edit">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['user-book-list.destroy', $book_list->id], 'style'=> 'display: inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="text-right">
    <a class="btn btn-success" href="/user-book-list/create">Create New Book List</a>
</div>