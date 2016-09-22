<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexPageWysiwygsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_page_wysiwygs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_up_first_text');
            $table->string('image_up_second_text');
            $table->string('image_up_third_text');
            $table->string('image_up_fourth_text');

            $table->string('section_one_header');
            $table->string('section_one_first_up_text');
            $table->string('section_one_first_bootom_text');
            $table->string('section_one_second_up_text');
            $table->string('section_one_second_down_text');
            $table->string('section_one_third_up_text');
            $table->string('section_one_third_down_text');
            $table->string('section_one_fourth_up_text');
            $table->string('section_one_fourth_down_text');
            $table->string('section_one_fifth_up_text');
            $table->string('section_one_fifth_down_text');

            $table->string('image_1');
            $table->string('image_2');

            $table->string('section_three_heading');
            $table->string('section_three_image1');
            $table->string('section_three_image2');
            $table->string('section_three_image3');
            $table->string('section_three_image4');
            $table->string('section_three_image5');
            $table->string('section_three_image6');
            $table->string('section_three_image7');
            $table->string('section_three_image8');
            $table->string('section_three_image9');
            $table->string('section_three_image10');
            $table->string('section_three_image11');
            $table->string('section_three_image12');
            $table->string('section_three_image13');
            $table->string('section_three_image14');
            $table->string('section_three_image15');
            $table->string('section_three_image16');

            $table->string('section_four_heading_upper');
            $table->string('section_four_heading_bottom');
            $table->string('section_four_first_text');
            $table->string('section_four_second_text');
            $table->string('section_four_third_text');

            $table->string('video_link');
            $table->string('image_3');

            $table->string('section_five_first_text_up');
            $table->string('section_five_first_text_mid');
            $table->string('section_five_first_text_bottom');
            $table->string('section_five_second_text_up');
            $table->string('section_five_second_text_mid');
            $table->string('section_five_second_text_bottom');
            $table->string('section_five_third_text_up');
            $table->string('section_five_third_text_mid');
            $table->string('section_five_third_text_bottom');
            $table->string('section_five_fourth_text_up');
            $table->string('section_five_fourth_text_mid');
            $table->string('section_five_fourth_text_bottom');
            $table->string('section_five_fifth_text_up');
            $table->string('section_five_fifth_text_mid');
            $table->string('section_five_fifth_text_bottom');
            $table->string('section_five_sixth_text_up');
            $table->string('section_five_sixth_text_mid');
            $table->string('section_five_sixth_text_bottom');

            $table->string('section_six_first_text');
            $table->string('section_six_second_text');

            $table->string('footer_section_one_header');
            $table->string('footer_section_one_first');

            $table->string('footer_section_two_header');

            $table->string('footer_section_three_header');
            $table->string('footer_section_three_first');
            $table->string('footer_section_three_second');
            $table->string('footer_section_three_third');

            $table->string('footer_section_four_header');
            $table->string('footer_section_four_first');

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
        Schema::drop('index_page_wysiwygs');
    }
}
