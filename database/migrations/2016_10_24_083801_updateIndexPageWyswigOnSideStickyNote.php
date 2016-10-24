<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateIndexPageWyswigOnSideStickyNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('index_page_wysiwygs', function($table) {
            $table->string('sticky_note_text')->nullable();
            $table->integer('is_sticky_active')->nullable()->comment = "1->active , 0->closed";
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
