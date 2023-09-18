<?php

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
            $table->id('id');
            $table->string('name_brides');
            $table->string('name_grooms');
            $table->date('day_wedding');
            $table->string('address_brides')->nullable();
            $table->string('address_grooms')->nullable();
            $table->string('phone_birdes')->nullable();
            $table->string('phone_grooms')->nullable();
            $table->string('map_birdes')->nullable();
            $table->string('map_grooms')->nullable();
            $table->string('facebook_birdes')->nullable();
            $table->string('facebook_grooms')->nullable();
            $table->string('logo')->nullable();
            $table->string('link_website')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
