<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonListResidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_list_residences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('residencePlaceID');
            $table->string('reStartYearHijri')->nullable();
            $table->string('reEndYearHijri')->nullable();
            $table->string('reStartYearIsae')->nullable();
            $table->string('reEndYearIsae')->nullable();
            $table->unsignedBigInteger('residenceable_id');
            $table->string('residenceable_type');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('residencePlaceID')->references('id')->on('place_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_list_residences');
    }
}
