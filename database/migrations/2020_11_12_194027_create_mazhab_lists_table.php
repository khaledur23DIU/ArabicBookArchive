<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMazhabListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mazhab_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mazhabType');
            $table->string('mazhabName');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('mazhabType')->references('id')->on('mazhab_type_lists')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mazhab_lists');
    }
}
