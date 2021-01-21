<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_basic_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bookID');
            $table->string('startYearHijri')->nullable();
            $table->string('endYearHijri')->nullable();
            $table->string('startYearIsae')->nullable();
            $table->string('endYearIsae')->nullable();
            $table->unsignedBigInteger('languageID')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('bookID')->references('id')->on('book_lists')->onDelete('cascade');
            $table->foreign('languageID')->references('id')->on('language_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_basic_infos');
    }
}
