<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishedInfoEditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('published_info_editors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('basic_book_id');
            $table->unsignedBigInteger('editorID');
            $table->string('workCategory')->nullable();
            $table->longText('description')->nullable();
            $table->foreign('basic_book_id')->references('id')->on('book_basic_infos')->onDelete('cascade');
            $table->foreign('editorID')->references('id')->on('person_lists')->onDelete('cascade');
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
        Schema::dropIfExists('published_info_editors');
    }
}
