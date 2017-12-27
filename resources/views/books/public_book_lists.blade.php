<?php
$book_lists = App\UserBookList::where(['public' => true])->get();
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Owner</th>
        <th>Public</th>
        <th>Updated Date</th>
        <th>Created Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($book_lists as $book_list)
        <tr>
            <td><a href="{{ route('book-list.show', $book_list->id) }}">{{ $book_list->name }}</a></td>
            <td>{{ $book_list->description }}</td>
            <td>{{ App\User::find($book_list->user_id)->name }}</td>
            <td>{{ ($book_list->public) ? 'Yes' : 'No' }}</td>
            <td>{{ $book_list->updated_at }}</td>
            <td>{{ $book_list->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>