<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookAPIController extends Controller
{
    public function index($query)
    {
        $ch = curl_init('http://openlibrary.org/search.json?limit=10&title='.$_GET['query']);
        curl_exec($ch);
    }
}
