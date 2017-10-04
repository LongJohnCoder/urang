<?php

use Illuminate\Database\Seeder;
use App\EmailTemplateSignUp;

class EmailTemplateSignUpTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $has_elements = EmailTemplateSignUp::first();
        if(!$has_elements)
        {
        	$sign_email = new EmailTemplateSignUp();
        	$sign_email->first_writeup = "Thank you for signing up with U-Rang.com. We appreciate your business. Please feel free to reach out to us with any additional questions or concerns. We can be reached via email at Lisa@u-rang.com or by phone at (646)902-5326.";
        	$sign_email->image_link = "https://media-cdn.tripadvisor.com/media/photo-s/03/9b/2d/f2/new-york-city.jpg";
        	$sign_email->login_link = "https://www.u-rang.com//login";
        	$sign_email->website_link = "https://www.u-rang.com/";
        	$sign_email->fb_link = "http://facebook.com/";
        	$sign_email->twitter_link = "http://twitter.com";
        	$sign_email->google_link = "http://google.com";
        	$sign_email->phone_no = "(646)902-5326";
        	$sign_email->email_link = "lisa@u-rang.com";
        	$sign_email->save();
        }
    }
}
