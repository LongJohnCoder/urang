<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplateSignUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_template_sign_ups', function (Blueprint $table) {
            $table->increments('id');
            $table->text('first_writeup');
            $table->string('image_link');
            $table->string('login_link');
            $table->string('website_link');
            $table->string('fb_link');
            $table->string('twitter_link');
            $table->string('google_link');
            $table->string('phone_no');
            $table->string('email_link');
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
        Schema::drop('email_template_sign_ups');
    }
}
