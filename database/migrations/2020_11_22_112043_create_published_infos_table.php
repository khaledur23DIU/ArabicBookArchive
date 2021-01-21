<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishedInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('published_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('basic_book_id');
            $table->unsignedBigInteger('publisherID');
            $table->foreign('basic_book_id')->references('id')->on('book_basic_infos')->onDelete('cascade');
            $table->foreign('publisherID')->references('id')->on('person_lists')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('published_infos');
    }
}
