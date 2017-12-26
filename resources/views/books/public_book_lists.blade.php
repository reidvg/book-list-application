<?php
$book_lists = App\UserBookList::where('public', true)
    ->orderBy('name')
    ->get();
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    @foreach($book_lists as $book_list)
        <tr>
            <td>{{ $book_list->name }}</td>
            <td>{{ $book_list->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>