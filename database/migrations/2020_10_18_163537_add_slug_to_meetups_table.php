<?php

use App\Models\Meetup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddSlugToMeetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetups', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        $animexxEvents = collect(getDataForAnimexxMeetupSeries(config('site.animexx_event_series_id'))->data->events);

        Meetup::all()->each(function (Meetup $meetup) use ($animexxEvents) {
            $meetup->slug = $meetup->is_manually_added ? Str::slug($meetup->name) : $animexxEvents->filter(function ($event) use ($meetup) { return $event->id === $meetup->external_id; })->first()->slug;

            $meetup->save();
        });

        Schema::table('meetups', function (Blueprint $table) {
            $table->string('slug')->change();
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
            $table->dropColumn('slug');
        });
    }
}
