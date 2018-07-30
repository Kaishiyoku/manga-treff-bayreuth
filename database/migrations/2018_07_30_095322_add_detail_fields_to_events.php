<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Event;

class AddDetailFieldsToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('address');
            $table->string('category');
            $table->string('size');
            $table->text('description');
        });

        // clear all events afterwards so that the additional needed date is being fetched
        Event::truncate();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('category');
            $table->dropColumn('size');
            $table->dropColumn('description');
        });
    }
}
