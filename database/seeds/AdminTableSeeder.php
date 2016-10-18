<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$search_admin = Admin::first();
        if ($search_admin) {
            return false;
        }
        else
        {
            $admin =new Admin();
            $admin->username = "Jon Vaughn";
            $admin->email = "jonvaughn@urang.com";
            $admin->password = bcrypt('123456');
            $admin->save(); 
        }*/
        $admin = new Admin();
        $admin->username = "Lisa Cear";
        $admin->email = "lisa@u-rang.com";
        $admin->password = bcrypt('123456');
        $admin->save();
    }
}
