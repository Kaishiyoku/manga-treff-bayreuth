<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Meetup;

class AddAdditionalFieldsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('events')->truncate();

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('category');
            $table->dropColumn('size');
            $table->dropColumn('description');

            $table->string('name');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->string('zip');
            $table->string('city');
            $table->string('state');
            $table->unsignedBigInteger('contact_id');
            $table->string('attendees');
            $table->text('intro');
            $table->string('main_image')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('country');
            $table->float('geo_lat');
            $table->float('geo_long');
            $table->integer('geo_zoom');
            $table->integer('geo_type');
            $table->unsignedBigInteger('event_type_external_id');

            $table->foreign('event_type_external_id')->references('external_id')->on('event_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('events')->truncate();

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('meetups_event_type_external_id_foreign');

            $table->dropColumn('name');
            $table->dropColumn('date_start');
            $table->dropColumn('date_end');
            $table->dropColumn('zip');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('contact_id');
            $table->dropColumn('attendees');
            $table->dropColumn('intro');
            $table->dropColumn('main_image');
            $table->dropColumn('logo_image');
            $table->dropColumn('country');
            $table->dropColumn('geo_lat');
            $table->dropColumn('geo_long');
            $table->dropColumn('geo_zoom');
            $table->dropColumn('geo_type');
            $table->dropColumn('event_type_external_id');

            $table->date('date');
            $table->string('category');
            $table->string('size');
            $table->text('description');
        });
    }
}
