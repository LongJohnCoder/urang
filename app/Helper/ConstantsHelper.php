<?php
namespace App\Helper;
use Session;
use Illuminate\Support\Facades\Auth;
use App\SiteConfig;
use App\User;
use App\CustomerCreditCardInfo;
use App\UserDetails;
use App\Neighborhood;
class ConstantsHelper 
{
	public static function getPagination() {
		return 10;
	}
	public static function getClintEmail()
	{
		return "work@tier5.us";
	}
	
}