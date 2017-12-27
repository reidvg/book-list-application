<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class test_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Testy McTesterface',
            'email' => 'test_user@gmail.com',
            'password' => bcrypt('booj'),
        ]);

        DB::table('book')->insert([
            [
                'author' => 'Testy McTesterface',
                'title' => 'The Great Book of Testing',
                'description' => 'Testy elaborates on how he began his career in testing.',
                'image' => 'upload/1/testing.jpg',
                'publication_date' => date('Y-m-d H:i:s', 1464082020),
                'public' => true,
                'creator_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'author' => 'Testy McTesterface',
                'title' => 'The Great Book of Testing Volume 2',
                'description' => 'In a sequel to Testy\'s Pulitzer prize winning "Great Book of Testing", Testy dives further into his testing methodologies.',
                'image' => 'upload/1/testing.jpg',
                'publication_date' => date('Y-m-d H:i:s', 1564082021),
                'public' => false,
                'creator_id' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
            ],
        ]);

        DB::table('user_book_lists')->insert([
            'name' => 'Testy\'s Reading List',
            'description' => 'A Collection of Testy McTesterFace\'s Favorites.',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'public' => true // I prefer saying if my booleans are 'true' or not.
        ]);

        DB::table('book_list')->insert([
            [
                'user_book_list_id' => 1,
                'book_id' => 1,
                'created_at' => date('Y-m-d', time()),
            ],
            [
                'user_book_list_id' => 1,
                'book_id' => 2,
                'created_at' => date('Y-m-d', time()),
            ]
        ]);


    }
}
