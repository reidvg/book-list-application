<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserBookListsRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_book_lists', function (Blueprint $table) {
            $table->foreign('book_list_id')->references('id')->on('book_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_book_lists', function (Blueprint $table) {
            $table->dropForeign(['book_list_id']);
        });
    }
}
