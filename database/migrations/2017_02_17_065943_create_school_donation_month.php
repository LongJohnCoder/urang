<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolDonationMonth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('school_order_donations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
           // $table->foreign('school_id')->references('id')->on('school_donations');
            $table->integer('donation_amount');
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
        //

        Schema::drop('school_order_donations');
    }
}
