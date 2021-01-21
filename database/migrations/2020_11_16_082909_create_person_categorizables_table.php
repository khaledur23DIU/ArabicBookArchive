<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonCategorizablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_categorizables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_category_id');
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_category_id')->references('id')->on('person_category_lists')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('person_lists')->onDelete('cascade');
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
        Schema::dropIfExists('person_categorizables');
    }
}
