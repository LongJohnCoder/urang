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


    /**
     * ZNG return custom metas for given key
     * @param string $key
     * @param object $site_details
     * @return null|object
     */
    public function getMetaCustomPages($key, $site_details){
	    $metas = [];

        $metas['home'] = [
            'site_title'=>'Dry Cleaners NYC | On Demand Dry Cleaning | U Rang',
            'meta_description'=>'#1 dry cleaners in NYC offering free pick-up and delivery, custom services specific to your needs. Dry cleaners are not all the same, learn why here.',
        ];
	    $metas['services'] = [
            'site_title'=>'Dry Cleaners NYC | Our Services | Dry Cleaning and Landry APP | U Rang',
            'meta_description'=>'Know as the best dry cleaners in NYC, U Rang offers a hassle free dry cleaning and laundry experience with free pick-up and delivery. Download app and enjoy a seamless experience.',
        ];
        $metas['sign-up'] = [
            'site_title'=>'Sign Up for an U Rang Account | U Rang',
            'meta_description'=>'Sign-up to U Rang today! Download app and receive superior dry cleaning services delivered to your office or to the comfort of your home with free pick-up and delivery.',
        ];
        $metas['contact-us'] = [
            'site_title'=>'On-Demand Dry Cleaning and Laundry | Contact U Rang',
            'meta_description'=>'Contact us today for custom laundry and dry cleaning services. U Rang offers hassle free pick-up and delivery in NYC and metro area free of charge.',
        ];
        $metas['faqs'] = [
            'site_title'=>'FAQ\'s On-Demand Dry Cleaners NYC | Dry Cleaning and Landry APP | U Rang',
            'meta_description'=>'U Rang Frequently Asked Questions - FAQ’s. Learn more about the most popular laundry & dry cleaner service in NYC.',
        ];
        $metas['prices'] = [
            'site_title'=>'Dry Cleaners Prices | On-Demand Dry Cleaners NYC | U Rang',
            'meta_description'=>'Unbeatable full-service dry cleaners prices in NYC. Be amazed with craft wash & fold services delivered to your door. We can do miracles! Contact U Rang today.',
        ];
        $metas['login'] = [
            'site_title'=>'On-Demand Dry Cleaning and Laundry | Login to your account | U Rang',
            'meta_description'=>'Log-in to your account and recieve on-demand dry cleaning and laundry with free pick-up and delivery in NYC.',
        ];
        $metas['school-donations'] = [
            'site_title'=>'Giving Back | On-Demand Dry Cleaning | Dry Cleaning and Landry APP | U Rang',
            'meta_description'=>'U Rang offers on-demand dry cleaning and laundry services in New York City. Schedule your free pickup and learn why U Rang is New York\'s favorite dry cleaning service.',
        ];
        $metas['forgot-password'] = [
            'site_title'=>'On-Demand Dry Cleaning | Dry Cleaning and Landry APP | U Rang',
            'meta_description'=>'On Demand Cleaning and Laundry App in NYC. U Rang - Forgot password.',
        ];

        if(isset($metas[$key])){
            if($site_details===null){
                $site_details = (object) $metas[$key];
            }else{
                $site_details->site_title = $metas[$key]['site_title'];
                $site_details->meta_description = $metas[$key]['meta_description'];
            }
        }

        return $site_details;
    }
}