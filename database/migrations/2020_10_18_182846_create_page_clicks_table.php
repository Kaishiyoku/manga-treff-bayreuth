<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_clicks', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('route');
            $table->string('uri');
            $table->timestamp('visited_at')->useCurrent();

            $table->index('ip');
            $table->index('user_id');
            $table->index('route');
            $table->index('visited_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_clicks');
    }
}
