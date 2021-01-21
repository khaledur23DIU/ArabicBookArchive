<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libraryName');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('library_lists');
    }
}
