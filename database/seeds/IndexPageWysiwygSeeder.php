<?php

use Illuminate\Database\Seeder;
use App\IndexPageWysiwyg;

class IndexPageWysiwygSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $has_elements = IndexPageWysiwyg::first();
        if(!$has_elements)
        {
        	$indexCms = new IndexPageWysiwyg();
        	$indexCms->image_up_first_text = "WE ARE U-RANG";
        	$indexCms->image_up_second_text = "NEW YORK CITY'S #1";
        	$indexCms->image_up_third_text = "Concierge Dry Cleaning Service";
        	$indexCms->image_up_fourth_text = "Owned and Operated Facility in Manhattan";

        	$indexCms->section_one_header = "OUR SERVICES";
        	$indexCms->section_one_first_up_text = "DRY CLEAN ONLY";
        	$indexCms->section_one_first_bootom_text = "Dry Cleaners are not the same. We'll show you why.";
        	$indexCms->section_one_second_up_text = "WASH & FOLD";
        	$indexCms->section_one_second_down_text = "If you never tried our service you are in for a treat.";
        	$indexCms->section_one_third_up_text = "CORPORATE";
        	$indexCms->section_one_third_down_text = "Corporate Events from Catering and Uniforms to Large Sport ivents.";
        	$indexCms->section_one_fourth_up_text = "TAILORING";
        	$indexCms->section_one_fourth_down_text = "Tailoring how much simpler can it be, we have an onsite tailor that handles A to Zippers.";
        	$indexCms->section_one_fifth_up_text = "WET CLEANING";
        	$indexCms->section_one_fifth_down_text = "Wet cleaning is professional fabric care using water and special non-toxic soaps.";

        	$indexCms->image_1 = "laptop.jpg";
        	$indexCms->image_2 = "content-logo.png";

        	$indexCms->section_three_heading = "NEIGHBORHOODS WE SERVICE";
        	$indexCms->section_three_image1 ="img2.jpg";
        	$indexCms->section_three_image2 = "img3.jpg";
        	$indexCms->section_three_image3 = "img3.jpg";
        	$indexCms->section_three_image4 = "img4.jpg";
        	$indexCms->section_three_image5 = "img5.jpg";
        	$indexCms->section_three_image6 = "img6.jpg";
        	$indexCms->section_three_image7 = "img7.jpg";
        	$indexCms->section_three_image8 = "img8.jpg";
        	$indexCms->section_three_image9 = "img9.jpg";
        	$indexCms->section_three_image10 = "img10.jpg";
        	$indexCms->section_three_image11 = "img11.jpg";
        	$indexCms->section_three_image12 = "img12.jpg";
        	$indexCms->section_three_image13 = "img13.jpg";
        	$indexCms->section_three_image14 = "img14.jpg";
        	$indexCms->section_three_image15 = "img15.jpg";
        	$indexCms->section_three_image16 = "img16.jpg";

        	$indexCms->section_four_heading_upper = "SIMPLE STEPS . QUICK RESULTS";
        	$indexCms->section_four_heading_bottom = "We make it easy, so you don't have to worry!";
        	$indexCms->section_four_first_text = "PLACE YOUR ORDER .";
        	$indexCms->section_four_second_text = "WE PICK-UP & CLEAN .";
        	$indexCms->section_four_third_text = "WE RETURN & DELIVER .";

        	$indexCms->video_link = "https://www.youtube.com/watch?v=un0cZhW-6jQ";
        	$indexCms->image_3 = "browsers-image.png";
        	$indexCms->section_five_first_text_up = "ECO-FREINDLY";
        	$indexCms->section_five_first_text_mid = "best solutions that works";
        	$indexCms->section_five_first_text_bottom = "Environmentally conscious about what chemicals are used for our customers.";
        	$indexCms->section_five_second_text_up = "WEB & MOBILE BASED";
        	$indexCms->section_five_second_text_mid = "Moving Forward.";
        	$indexCms->section_five_second_text_bottom = "Our site is designed mobile first, so you can browse from any device, phone, tablet or desktop.";
        	$indexCms->section_five_third_text_up = "AMAZING SERVICE";
        	$indexCms->section_five_third_text_mid = "Direct Line to Owner";
        	$indexCms->section_five_third_text_bottom = "Direct Owner Mobile Number – #1 priority, for our clients.";
        	$indexCms->section_five_fourth_text_up = "PHILANTHROPIC";
        	$indexCms->section_five_fourth_text_mid = "Give back to your Community";
        	$indexCms->section_five_fourth_text_bottom = "Donate to the school of your choice in your very own community.";
        	$indexCms->section_five_fifth_text_up = "AFFORDABLE PRICING";
        	$indexCms->section_five_fifth_text_mid = "Honest and Transparent";
        	$indexCms->section_five_fifth_text_bottom = "Affordable services with fair prices without mark-ups.";
        	$indexCms->section_five_sixth_text_up = "CORPORATE";
        	$indexCms->section_five_sixth_text_mid = "Putting your Best Foot Forward.";
        	$indexCms->section_five_sixth_text_bottom = "We've worked in Corporate America as-well. Looking good and feeling good is the first step in winning business.";

        	$indexCms->section_six_first_text = "U-RANG IS NEW YORK CITY'S #1 CONCIERGE SERVICE";
        	$indexCms->section_six_second_text = "With more than 10+ years in Business, we are the Best.";

        	$indexCms->footer_section_one_header = "ABOUT US";
        	$indexCms->footer_section_one_first = "U-Rang has been servicing the many affluent neigborhoods of New York City for more than 10 years. Our goals are simple, provide the best service while giving back to the community.";

        	$indexCms->footer_section_two_header = "SITEMAP";

        	$indexCms->footer_section_three_header = "CONTACT INFO";
        	$indexCms->footer_section_three_first = "15 Broad Street New York, NY 10005";
        	$indexCms->footer_section_three_second = "(800)959-5785";
        	$indexCms->footer_section_three_third = "lisa@u-rang.com";

        	$indexCms->footer_section_four_header = "CONTACT INFO";
        	$indexCms->footer_section_four_first = "355 E 23rd Street New York, NY 10010";
            $indexCms->sticky_note_text = "10% off on new sign up";
            $indexCms->is_sticky_active = 1;

        	$indexCms->save();
        }
    }
}
