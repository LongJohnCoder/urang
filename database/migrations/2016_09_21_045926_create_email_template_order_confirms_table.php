<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplateOrderConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_template_order_confirms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('thank_you_text');
            $table->string('image_link');
            $table->string('website_link');
            $table->string('address');
            $table->string('phone_no');
            $table->string('support_email');
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
        Schema::drop('email_template_order_confirms');
    }
}
