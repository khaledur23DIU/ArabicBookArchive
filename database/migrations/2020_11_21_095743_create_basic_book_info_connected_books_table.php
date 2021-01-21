<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicBookInfoConnectedBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_book_info_connected_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('connectedBookID');
            $table->unsignedBigInteger('connectedBookCategoryID');
            $table->boolean('positionUp')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('connected_bookable_id');
            $table->string('connected_bookable_type');
            $table->softDeletes();
            $table->foreign('connectedBookID')->references('id')->on('book_lists');
            $table->foreign('connectedBookCategoryID')->references('id')->on('book_category_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basic_book_info_connected_books');
    }
}
