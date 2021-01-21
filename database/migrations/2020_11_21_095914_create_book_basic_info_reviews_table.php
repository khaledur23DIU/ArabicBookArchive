<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookBasicInfoReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_basic_info_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reviewBookID');
            $table->longText('review');
            $table->unsignedBigInteger('reviewable_id');
            $table->string('reviewable_type');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('reviewBookID')->references('id')->on('book_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_basic_info_reviews');
    }
}
