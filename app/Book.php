<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    public $in_list = false;
    protected $fillable = [
        'title', 'description', 'author', 'image', 'publication_date', 'public', 'creator_id'
    ];

    public function belongsToList()
    {
        return $this->belongsToMany('App\UserBookList', 'book_list');
    }
}
