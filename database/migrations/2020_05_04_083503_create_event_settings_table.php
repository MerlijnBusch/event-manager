<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\EventSettings;

class CreateEventSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('visible_registrations')->default(EventSettings::__VISIBLE_REGISTRATIONS__);
            $table->integer('max_registrations')->default(EventSettings::__MAX_REGISTRATIONS__);
            $table->string('color');
            $table->boolean('light_theme');
            $table->string('date_start');
            $table->string('date_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_settings');
    }
}
