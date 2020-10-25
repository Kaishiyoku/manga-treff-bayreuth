<?php

use App\Enums\SettingType;
use App\Enums\SettingValueType;
use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('name')->primary();
            $table->char('value_type', '20');
            $table->text('value')->nullable();
        });

        $aboutUsTextSetting = new Setting();
        $aboutUsTextSetting->name = SettingType::AboutUsText;
        $aboutUsTextSetting->value_type = SettingValueType::StringText;

        $aboutUsTextSetting->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
