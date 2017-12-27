<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookList extends Model
{
    protected $table = 'book_list';

    public function books()
    {
        return $this->hasMany('App\Book', 'id');
    }

    public function userBookList()
    {
        return $this->hasOne('App\UserBookList');
    }

}
