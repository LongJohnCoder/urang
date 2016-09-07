<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerComplaintsEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_complaints_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cover_image');
            $table->text('company_info');
            $table->string('website_link');
            $table->string('address');
            $table->bigInteger('phone_no');
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
        Schema::drop('customer_complaints_emails');
    }
}
