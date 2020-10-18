<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetupUserRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetup_user_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meetup_id');
            $table->foreignId('user_id');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('meetup_id')->references('id')->on('meetups');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['meetup_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetup_user_registrations');
    }
}
