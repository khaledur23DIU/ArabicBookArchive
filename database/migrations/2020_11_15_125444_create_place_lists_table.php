<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('countryID');
            $table->string('city');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('countryID')->references('id')->on('country_lists')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_lists');
    }
}
