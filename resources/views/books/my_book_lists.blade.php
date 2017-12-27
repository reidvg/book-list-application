<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Owner</th>
        <th>Public</th>
        <th>Updated</th>
        <th>Created Date</th>
        <th></th>
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
            <td>
                @if(Auth::check())
                    @if($book_list->user_id == Auth::user()->id)
                        <a class="btn btn-success" href="{{ route('book-list.reading-list.index', $book_list->id) }}">Modify List</a>
                        <a class="btn btn-warning" href="/book-list/{{ $book_list->id }}/edit">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['book-list.destroy', $book_list->id], 'style'=> 'display: inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endif
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>