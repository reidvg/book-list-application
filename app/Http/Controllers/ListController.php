<?php

namespace App\Http\Controllers;

use App\BookList;
use App\UserBookList;
use App\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($book_list_id)
    {
        $user_list = UserBookList::find($book_list_id);
        $books = Book::where(['creator_id' => Auth::user()->id])->orWhere(['public' => true])->get();
        $all_books = [];

        foreach ($books as $book) {
            $book->in_list = false;
            $all_books[$book->id] = $book;
        }

        foreach($user_list->books as $book) {
            $book->in_list = true;
            if($book->public == true or (isset(Auth::user()->id) and $book->creator_id == Auth::user()->id)) {
                $all_books[$book->id] = $book;
            }
        }

        return view('books.reading-list.index', [
            'model' => $user_list,
            'books' => $all_books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $post = $request->except('_token');
        $user_list = UserBookList::find($id);
        // Delete All Old Books
        BookList::where('user_book_list_id', $user_list->id)->delete();

        foreach ($post as $book_id => $in_list) {
            if ($in_list) {
                BookList::create([
                    'user_book_list_id' => $user_list->id,
                    'book_id' => $book_id
                ]);
            }
        }
        $count = count(BookList::where('user_book_list_id', $user_list->id)->get());
        $books = 'books';
        if ($count == 1) {
            $books = 'book';
        }
        return redirect()->route('book-list.show', $user_list->id)->with('success', "Your book list now has $count $books.");
    }

    public function updateListOrder()
    {
        // Update the sequence
        $book_orders = $_POST['book'];
        $list_id = $_POST['list_id'];

        $book_list = BookList::where('user_book_list_id', $list_id)->get();
        foreach ($book_orders as $order=>$book_id) {
            foreach ($book_list as $list) {
                if($list->book_id == $book_id) {
                    $list->sequence = $order;
                    $list->update();
                }
            }
        }

    }

}
