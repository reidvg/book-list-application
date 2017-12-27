<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookList extends Model
{
    protected $table = 'book_list';

    public function book()
    {
        return $this->hasOne('App\Book', 'id', 'book_id');
    }

    public function userBookList()
    {
        return $this->hasOne('App\UserBookList');
    }

}
