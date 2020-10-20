<?php

use App\Models\MeetupType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToMeetupTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetup_types', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        MeetupType::all()->each(function (MeetupType $meetupType) {
            $meetupType->update();
        });

        Schema::table('meetup_types', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meetup_types', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
