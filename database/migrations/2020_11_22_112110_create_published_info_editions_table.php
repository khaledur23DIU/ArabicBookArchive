<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishedInfoEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('published_info_editions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('basic_book_id');
            $table->bigInteger('editionNo');
            $table->string('editionYearHijri')->nullable();
            $table->string('editionYearIsae')->nullable();
            $table->bigInteger('partCount');
            $table->bigInteger('pageCount');
            $table->bigInteger('pageSize')->nullable();
            $table->longText('errors')->nullable();
            $table->longText('description')->nullable();
            $table->text('coverPhotoLink')->nullable();
            $table->text('pdfLink')->nullable();
            $table->foreign('basic_book_id')->references('id')->on('book_basic_infos')->onDelete('cascade');
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
        Schema::dropIfExists('published_info_editions');
    }
}
