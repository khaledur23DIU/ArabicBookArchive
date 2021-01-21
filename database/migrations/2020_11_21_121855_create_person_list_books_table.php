<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonListBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_list_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('book_list_id');
            $table->unsignedBigInteger('person_list_bookable_id');
            $table->string('person_list_bookable_type');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('book_list_id')->references('id')->on('book_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_list_books');
    }
}
