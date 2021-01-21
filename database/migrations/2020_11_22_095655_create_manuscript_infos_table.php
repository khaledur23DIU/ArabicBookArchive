<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManuscriptInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuscript_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bookID');
            $table->unsignedBigInteger('libraryID');
            $table->string('indexInLibrary')->nullable();
            $table->string('writtenYearHijri')->nullable();
            $table->string('writtenYearIsae')->nullable();
            $table->bigInteger('pageCount')->nullable();
            $table->bigInteger('pageSize')->nullable();
            $table->bigInteger('lineCountPerPage')->nullable();
            $table->longText('someStratingLine')->nullable();
            $table->longText('someEndingLine')->nullable();
            $table->longText('errors')->nullable();
            $table->longText('description')->nullable();
            $table->text('pdfLink')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('bookID')->references('id')->on('book_lists')->onDelete('cascade');
            $table->foreign('libraryID')->references('id')->on('library_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manuscript_infos');
    }
}
