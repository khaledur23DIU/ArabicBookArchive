<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name')->default('Archive');
            $table->string('site_email')->default('archive@gmail.com');
            $table->string('site_address')->default('https://archive.com');
            $table->text('site_description')->nullable();
            $table->text('site_logo')->default('http://localhost:8000/assets/backend/app-assets/images/logo/materialize-logo-color.png');
            $table->text('site_favicon')->default('http://localhost:8000/assets/backend/app-assets/images/favicon/favicon-32x32.png');
            $table->text('user_avatar')->default('http://localhost:8000/assets/backend/app-assets/images/avatar/avatar-7.png');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('footer_text')->default('All Right Reserved By Archive');
            $table->boolean('mail_verified')->default(0);
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
        Schema::dropIfExists('site_settings');
    }
}
