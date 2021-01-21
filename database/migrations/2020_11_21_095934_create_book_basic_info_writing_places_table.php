<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookBasicInfoWritingPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_basic_info_writing_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('writingPlaceID');
            $table->string('writingStartYearHijri')->nullable();
            $table->string('writingEndYearHijri')->nullable();
            $table->string('writingStartYearIsae')->nullable();
            $table->string('writingEndYearIsae')->nullable();
            $table->unsignedBigInteger('writing_placeable_id');
            $table->string('writing_placeable_type');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('writingPlaceID')->references('id')->on('place_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_basic_info_writing_places');
    }
}
