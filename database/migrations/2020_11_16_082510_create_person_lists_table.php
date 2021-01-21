<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('personName');
            $table->string('surName')->nullable();
            $table->string('fathersName')->nullable();
            $table->integer('birthYearHijri')->nullable();
            $table->integer('birthYearIsae')->nullable();
            $table->unsignedBigInteger('birthPlaceID')->nullable();
            $table->unsignedBigInteger('deathPlaceID')->nullable();
            $table->integer('deathYearHijri')->nullable();
            $table->integer('deathYearIsae')->nullable();
            $table->string('kuniad')->nullable();
            $table->string('popularity')->nullable();
            $table->unsignedBigInteger('mazhabFikih')->nullable();
            $table->unsignedBigInteger('mazhabAkidah')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('draft')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('birthPlaceID')->references('id')->on('place_lists');
            $table->foreign('deathPlaceID')->references('id')->on('place_lists');
            $table->foreign('mazhabFikih')->references('id')->on('mazhab_lists')->onDelete('cascade');
            $table->foreign('mazhabAkidah')->references('id')->on('mazhab_lists')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_lists');
    }
}
