<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublisherListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ownerID');
            $table->string('publicationName');
            $table->unsignedBigInteger('placeID')->nullable();
            $table->string('stablishedYearHijri')->nullable();
            $table->string('stablishedYearIsae')->nullable();
            $table->text('web')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('mobile')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linkedIn')->nullable();
            $table->text('youtube')->nullable();
            $table->text('locationMapLink')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ownerID')->references('id')->on('person_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publisher_lists');
    }
}
