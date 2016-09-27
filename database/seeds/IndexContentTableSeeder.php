<?php

use Illuminate\Database\Seeder;
use App\IndexContent;

class IndexContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $has_elements = IndexContent::first();
        if(!$has_elements)
        {
        	$sign_email = new IndexContent();
        	$sign_email->tag_line = "We think, We Listen, We Care";
        	$sign_email->header = "Areas of expertise";
        	$sign_email->tag_line_2 = "We cover every aspect of a domestic concierge servcice.";
        	$sign_email->tag_line_3 = "Serving NYC online for over 10 years.";
        	$sign_email->tag_line_4 = "Fine Dry Cleaning and Laundry Service in New York City - Straight to Your Door";
        	$sign_email->head_setion = "Owned and Operated facility in Manhattan";
        	$sign_email->contents = "Organic cleaning, offering our clients wet cleaning service in New York City (NYC), true Eco-friendly cleaning. Free pick-up and delivery on all dry cleaning and wash and fold service in NYC. The finest Wash & Fold, laundry Service in New York City. Expert stain removal and restoration for your fine garments. Each garment is personally inspected and treated for the highest quality. We clean the finest leather and suede. We offer you full storage on all your clothes including a fur vault.";
        	$sign_email->head_section_2 = "Corporate";
        	$sign_email->contents_2 = "Dry Cleaning service for staff and buildings Work directly with property management companies and property mangers Laundry and dry cleaning service for corporate events and special events Executive Wash & Fold service for nursery schools, Hedge funds, Executive gyms and corporate companies.";
        	$sign_email->image = "http://stage.u-rang.co/public/dump_images/169877040.jpg";
        	$sign_email->save();
        }
    }
}
