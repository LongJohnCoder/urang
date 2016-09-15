<?php

use Illuminate\Database\Seeder;
use App\SchoolDonationPercentage;

class SchoolDonationPercentageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_record = SchoolDonationPercentage::first();
        if ($check_record) {
        	return false;
        } else {
        	$insert = new SchoolDonationPercentage();
        	$insert->percentage = 10;
        	$insert->save();
        }
    }
}
