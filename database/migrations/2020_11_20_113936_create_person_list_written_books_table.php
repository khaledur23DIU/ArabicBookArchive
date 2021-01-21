<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonListWrittenBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_list_written_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('writtenBook');
            $table->unsignedBigInteger('written_bookable_id');
            $table->string('written_bookable_type');
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
        Schema::dropIfExists('person_list_written_books');
    }
}
