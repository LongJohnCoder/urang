<?php

use Illuminate\Database\Seeder;
use App\CustomerComplaintsEmail;

class CompliantsEmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$has_compliants = CustomerComplaintsEmail::first();
    	if(!$has_compliants)
    	{
    		$compliants =new CustomerComplaintsEmail();
	        $compliants->cover_image = "http://u-rang.tier5-portfolio.com/public/images/com.png";
	        $compliants->company_info = "U-rang offers clients wet cleaning service in New York City (NYC),true Eco-friendly cleaning.
										Free pick-up and delivery on all dry cleaning and wash and fold service in NYC.
										The finest Wash & Fold, laundry Service in New York City.
										Expert stain removal and restoration for your fine garments.
										Each garment is personally inspected and treated for the highest quality.
										We clean the finest leather and suede.
										We offer you full storage on all your clothes including a fur vault.";
	        $compliants->website_link = "http://dev.u-rang.com";
	        $compliants->address = "150 Broad Street New York, NY 10005";
	        $compliants->phone_no = 8009595785;
	        $compliants->support_email = "support@u-rang.com";
	        $compliants->save();
    	}
    }
}
