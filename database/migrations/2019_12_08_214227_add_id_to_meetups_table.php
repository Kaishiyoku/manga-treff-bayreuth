<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdToMeetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('ALTER TABLE meetups DROP PRIMARY KEY');

        Schema::table('meetups', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('external_id')->nullable(true)->change();

            $table->index('external_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('ALTER TABLE meetups DROP PRIMARY KEY');

        Schema::table('meetups', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->primary('external_id');
        });
    }
}
