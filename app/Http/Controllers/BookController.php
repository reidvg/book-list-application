<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::where(['creator_id' => Auth::user()->id])->get();
        return view('books.book.index', ['model' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.book.create');

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
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'publication_date' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = $this->validateImage($request);

        if(!$post) {
            return redirect()->route('book.index')->with('error','Failed to update your book.');
        }

        $post['creator_id'] = Auth::user()->id;

        Book::create($post);
        return redirect()->route('book.index')->with('success','Your book has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(isset($id) and is_numeric($id)) {
            $book = Book::where(['id' => $id])->first();
            if($book) {
                return view('books.book.show', ['model' => $book]);
            }
        }
        return redirect()->route('book.index')->with('error', "There is no book list with that ID: $id");
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
            $book = Book::where(['id' => $id])->first();
            if($book) {
                return view('books.book.edit', ['model' => $book]);
            }
        }
        return redirect()->route('book.index')->with('error', "There is no book list with that ID: $id");
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
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'publication_date' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = $this->validateImage($request);

        if(!$post) {
            return redirect()->route('book.index')->with('error','Failed to update your book.');
        }

        $this->removeOldImage($id);

        Book::find($id)->update($post);
        return redirect()->route('book.index')->with('success','Your book has been updated.');

    }

    private function validateImage($request)
    {
        $post = $request->except('_token');
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' .$image->getClientOriginalExtension();
            $destination = public_path('/images');
            if($image->move($destination, $name)) {
                $post['image'] = $name;
                return $post;
            }
            return false;
        }
        return $post;
    }

    public function removeOldImage($id)
    {
        $book = Book::find($id);
        $old_image = $book->image;
        if(File::exists('images/' . $old_image)) {
            echo 'destroying';
            File::delete('images/' . $old_image);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->removeOldImage($id);
        Book::find($id)->delete();
        return redirect()->route('book.index')->with('success','Your book was deleted successfully');
    }
}
