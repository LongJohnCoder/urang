<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UpdateCustomerCreditCardInfosTableAddColumnsStripeDetials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_credit_card_infos', function (Blueprint $table) {
            $table->string('card_id')
                ->nullable();
            $table->string('card_fingerprint')
                ->nullable();
            $table->string('card_country')
                ->nullable();
            $table->string('stripe_customer_id')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_credit_card_infos', function (Blueprint $table) {
            $table->dropColumn([
               'card_id',
               'card_brand',
               'card_fingerprint',
               'card_country',
               'stripe_customer_id'
            ]);
        });
    }
}
