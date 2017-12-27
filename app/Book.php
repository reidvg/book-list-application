<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    protected $fillable = [
        'title', 'description', 'author', 'image', 'publication_date', 'public', 'creator_id'
    ];
}
