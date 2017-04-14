<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePickupRequestTableAddColumnIsEligibleForSignUpDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pickupreqs', function (Blueprint $table) {
            $table->boolean('sign_up_discount')
                ->comment('0 => not eligible, 1 => eligible')
                ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pickupreqs', function (Blueprint $table) {
            $table->dropColumn('sign_up_discount');
        });
    }
}
