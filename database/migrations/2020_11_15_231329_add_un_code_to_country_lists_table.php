<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnCodeToCountryListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('country_lists', function (Blueprint $table) {
            $table->integer('country_un_code')->unique()->after('country_iso_code_3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('country_lists', function (Blueprint $table) {
            $table->dropColumn('country_un_code');
        });
    }
}
