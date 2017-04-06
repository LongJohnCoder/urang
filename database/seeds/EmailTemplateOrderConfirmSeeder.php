<?php

use Illuminate\Database\Seeder;
use App\EmailTemplateOrderConfirm;

class EmailTemplateOrderConfirmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $has_elements = EmailTemplateOrderConfirm::first();
        if(!$has_elements)
        {
        	$sign_email = new EmailTemplateOrderConfirm();
        	$sign_email->thank_you_text = "Thank You for submitting pickup!";
        	$sign_email->image_link = "https://cdn2.iconfinder.com/data/icons/perfect-flat-icons-2/512/Order_tracking_online_offer_cart_shopping.png";
        	$sign_email->website_link = "https://www.u-rang.com/";
        	$sign_email->address = "15 Broad Street New York, NY 10005";
        	$sign_email->phone_no = "(800)959-5785";
        	$sign_email->support_email = "lisa@u-rang.com";
        	$sign_email->save();
        }
    }
}
