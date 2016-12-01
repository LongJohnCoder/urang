<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserDetailsOnAddressLine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function($table) {
            $table->longText('address')->change();
            $table->renameColumn('address', 'address_line_1');
            $table->longText('address_line_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');
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
    }
}
