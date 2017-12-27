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
        foreach ($books as $book){
            if($book->belongsToList) {
                if($book->belongsToList->userBookList) {
                    $book->in_list = true;
                    $all_books[] = $book;
                    continue;
                }
            }
            $book->in_list = false;
            $all_books[] = $book;
        }
        return view('books.reading-list.index', [
            'model' => $user_list,
            'books' => $all_books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $post = $request->except('_token');
        $user_list = UserBookList::find($id);
        // Delete All Old Books
        BookList::where('user_book_list_id', $user_list->book_list_id)->delete();

        foreach ($post as $book_id => $in_list) {
            if($in_list) {
                BookList::create([
                    'user_book_list_id' => $user_list->book_list_id,
                    'book_id' => $book_id
                ]);
            }
        }
        $count = count(BookList::where('user_book_list_id', $user_list->book_list_id)->get());
        $books = 'books';
        if($count == 1) {
            $books = 'book';
        }
        return redirect()->route('book-list.show', $user_list->book_list_id)->with('success',"Your book list now has $count $books.");
    }

}
