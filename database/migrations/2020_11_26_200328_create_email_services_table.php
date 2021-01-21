<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('driver')->default('smtp');
            $table->string('host')->default('smtp.googlemail.com');
            $table->string('port')->default('465');
            $table->string('username')->default('archive@gmail.com');
            $table->string('password')->default('password');
            $table->string('mail_encryption')->default('ssl');
            $table->string('from_address')->default('archive@gmail.com');
            $table->string('from_name')->default('Archive');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_services');
    }
}
