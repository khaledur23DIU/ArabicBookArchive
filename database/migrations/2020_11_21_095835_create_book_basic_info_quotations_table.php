<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookBasicInfoQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_basic_info_quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('SLNo')->nullable();
            $table->longText('quotation');
            $table->unsignedBigInteger('info_quotationable_id');
            $table->string('info_quotationable_type');
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
        Schema::dropIfExists('book_basic_info_quotations');
    }
}
