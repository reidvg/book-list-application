<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBookList extends Model
{
    protected $table = 'user_book_lists';
    protected $fillable = [
        'name', 'description', 'public', 'user_id'
    ];

    public function bookList()
    {
        return $this->hasMany('App\BookList', 'user_book_list_id');
    }

    public function books()
    {
        return $this->hasMany('App\Book');
    }


}
