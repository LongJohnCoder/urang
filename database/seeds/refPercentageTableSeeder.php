<?php

use Illuminate\Database\Seeder;
use App\refPercentage;

class refPercentageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hasData = refPercentage::first();
        if (!$hasData) {
        	$percentage = new refPercentage();
        	$percentage->percentage = 10;
        	$percentage->save();
        } 
    }
}
