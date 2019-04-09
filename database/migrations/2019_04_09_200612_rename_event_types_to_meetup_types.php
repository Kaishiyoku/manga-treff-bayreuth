<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameEventTypesToMeetupTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('event_types', 'meetup_types');

        Schema::table('meetups', function (Blueprint $table) {
            $table->renameColumn('event_type_external_id', 'meetup_type_external_id');

            $table->foreign('meetup_type_external_id')->references('external_id')->on('meetup_types');
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
            $table->dropForeign('meetups_meetup_type_external_id_foreign');

            $table->renameColumn('meetup_type_external_id', 'event_type_external_id');
        });

        Schema::rename('meetup_types', 'event_types');

        Schema::table('meetups', function (Blueprint $table) {
            $table->foreign('event_type_external_id')->references('external_id')->on('event_types');
        });
    }
}
