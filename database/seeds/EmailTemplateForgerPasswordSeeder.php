<?php

use Illuminate\Database\Seeder;
use App\EmailTemplateForgetPassword;

class EmailTemplateForgerPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $has_elements = EmailTemplateForgetPassword::first();
        if(!$has_elements)
        {
        	$elements = new EmailTemplateForgetPassword();
        	$elements->write_up = "Hey, here is ur link";
        	$elements->save();
        }
    }
}
