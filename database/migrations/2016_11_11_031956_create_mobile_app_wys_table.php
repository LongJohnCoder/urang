<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileAppWysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_app_wys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('tagLine')->nullable();
            $table->string('above_title')->nullable();
            $table->longText('description_android')->nullable();
            $table->string('image_android')->nullable();
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
        Schema::drop('mobile_app_wys');
    }
}
