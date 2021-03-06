<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\UserBookList;
use Illuminate\Http\Request;

class UserBookListController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['only' => 'edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book_lists = UserBookList::where(['user_id' => Auth::user()->id])->get();
        return view('books.user_book_list.index', ['book_lists' => $book_lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.user_book_list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);
        $list = $request->all();
        $list['user_id'] = Auth::user()->id;
        UserBookList::create($list);
        return redirect()->route('book-list.index')->with('success','Your book list has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = UserBookList::where(['id' => $id])->first();
        if(!empty($model)) {
            $books = $model->books;
            $all_books = [];
            foreach ($books as $book) {
                if ($book->public == true or (isset(Auth::user()->id) and $book->creator_id == Auth::user()->id)) {
                    $all_books[] = $book;
                }
            }

            return view('books.user_book_list.show', ['model' => $model, 'books' => $all_books]);
        }
        return redirect()->route('home')->with('error', "There is no book list with that ID: $id");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(isset($id) and is_numeric($id)) {
            $user_book_list = UserBookList::where(['id' => $id])->first();
            if($user_book_list) {
                return view('books.user_book_list.edit', ['model' => $user_book_list]);
            }
        }
        return redirect()->route('book-list.index')->with('error', "There is no book list with that ID: $id");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);

        UserBookList::find($id)->update($request->all());
        return redirect()->route('book-list.index')->with('success','Your book list has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserBookList::find($id)->delete();
        return redirect()->route('book-list.index')->with('success','Your book list was deleted successfully');
    }
}
