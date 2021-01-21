<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManuscriptWritersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuscript_writers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('writer_id');
            $table->unsignedBigInteger('manuscript_id');
            $table->foreign('writer_id')->references('id')->on('person_lists')->onDelete('cascade');
            $table->foreign('manuscript_id')->references('id')->on('manuscript_infos')->onDelete('cascade');
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
        Schema::dropIfExists('manuscript_writers');
    }
}
