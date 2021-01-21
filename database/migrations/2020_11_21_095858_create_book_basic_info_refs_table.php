<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookBasicInfoRefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_basic_info_refs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('ref');
            $table->unsignedBigInteger('refable_id');
            $table->string('refable_type');
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
        Schema::dropIfExists('book_basic_info_refs');
    }
}
