<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\UserBookList;
use Illuminate\Http\Request;

class UserBookListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books.user_book_list.index');
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
        return redirect()->route('user-book-list.index')->with('success','Your book list has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(isset($id)) {
            $user_book_list = UserBookList::where(['id' => $id])->first();
            return view('books.user_book_list.show', ['model' => $user_book_list]);
        }
        return redirect('/user-book-list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(isset($id)) {
            $user_book_list = UserBookList::where(['id' => $id])->first();
            return view('books.user_book_list.edit', ['model' => $user_book_list]);
        }
        return redirect('/user-book-list');
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
        return redirect()->route('user-book-list.index')->with('success','Your book list has been updated.');
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
        return redirect()->route('user-book-list.index')->with('success','Your book list was deleted successfully');
    }
}
