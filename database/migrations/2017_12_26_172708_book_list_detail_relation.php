<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookListDetailRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_list', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('book')->onDelete('cascade');
            $table->foreign('user_book_list_id')->references('id')->on('user_book_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_list', function (Blueprint $table) {
            $table->dropForeign(['book_id', 'user_book_list_id']);
        });
    }
}
