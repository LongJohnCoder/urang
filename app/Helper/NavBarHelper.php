<?php
namespace App\Helper;
use Session;
use Illuminate\Support\Facades\Auth;
use App\SiteConfig;
use App\User;
use App\CustomerCreditCardInfo;
use App\UserDetails;
use App\Neighborhood;
use App\Cms;
use App\NeighborhoodSeo;
class NavBarHelper 
{
	public static function getUserData() {
		$user_data = Auth::user();
		return $user_data;
	}
	public function siteData() {
		$site_details = SiteConfig::first();
		return $site_details;
	}
	public static function getCustomerData() {
		if (auth()->guard('users')->user() != null) {
			$logged_id = auth()->guard('users')->user()->id;
			$customer_details = User::with('user_details', 'card_details')->where('id' , $logged_id)->first();
			return $customer_details;
		}
		else
		{
			$customer_details = null;
			return $customer_details;
		}
	}
	public function getNeighborhood() {
		$neighborhood = Neighborhood::all();
		return $neighborhood;
	}
	public function test()
	{
		return "test";
	}

	public function staffDetails()
	{
		$staff = auth()->guard('staffs')->user();

		return $staff;
	}
	public function getCmsData() {
		$dry_clean = Cms::where('identifier', 0)->first();
		$wash_n_fold = Cms::where('identifier', 1)->first();
		$corporate = Cms::where('identifier', 2)->first();
		$tailoring = Cms::where('identifier', 3)->first();
		$wet_clean = Cms::where('identifier', 4)->first();
		$data_feed = array(
			'dry_clean' => $dry_clean,
			'wash_n_fold' => $wash_n_fold,
			'corporate' => $corporate,
			'tailoring' => $tailoring,
			'wet_clean' => $wet_clean
		);
		return $data_feed;
	}
	public static function getNeighborhoodSeo() {
		$seo_data = NeighborhoodSeo::first();
		if ($seo_data) {
			return $seo_data;
		} else {
			return false;
		}
	}
	public static function getSeoDetailsNeighborhoodSingle($slug) {
		$getData = Neighborhood::where('url_slug', $slug)->first();
		if ($getData) {
			return $getData;
		} else {
			return false;
		}
	}
}