<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeLatAndLonFieldsNullableAtMeetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetups', function (Blueprint $table) {
            $table->float('geo_lat')->nullable()->change();
            $table->float('geo_long')->nullable()->change();
            $table->integer('geo_zoom')->nullable()->change();
            $table->integer('geo_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meetups', function (Blueprint $table) {
            $table->float('geo_lat')->change();
            $table->float('geo_long')->change();
            $table->integer('geo_zoom')->change();
            $table->integer('geo_type')->change();
        });
    }
}
