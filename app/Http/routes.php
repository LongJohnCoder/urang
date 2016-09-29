<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*landing page routes*/
/*Route::get('/email', function(){
    return view('email.complaintsTemplate');
});*/

/*Route::get('/email-pickup', function(){
    return view('email.pickupemail');
});*/
Route::get('/',['uses' => 'MainController@getIndex', 'as' => 'index']);
Route::get('/sign-up', ['uses' => 'MainController@getSignUp', 'as' => 'getSignUp']);
Route::post('/attmept-sign-up', ['uses' => 'MainController@postSignUp', 'as' => 'postSignUp']);
Route::get('/user-logout', ['uses' => 'MainController@getLogout', 'as' => 'getLogout']);
Route::get('/prices', ['uses' => 'MainController@getPrices', 'as' => 'getPrices']);
Route::get('/neighborhoods', ['uses' => 'MainController@getNeiborhoodPage', 'as' => 'getNeiborhoodPage']);
Route::get('/neighborhood/{slug}', ['uses' => 'MainController@getStandAloneNeighbor', 'as' => 'getStandAloneNeighbor']);
Route::get('/faqs', ['uses' => 'MainController@getFaqList', 'as' => 'getFaqList']);
Route::post('/email-checker', ['uses' => 'MainController@emailChecker', 'as' => 'postEmailChecker']);
Route::get('/contact-us',['uses' => 'MainController@getContactUs', 'as' => 'getContactUs']);
Route::post('/postContactForm',['uses' => 'MainController@postContactForm', 'as' => 'postContactForm']);
Route::get('/school-donations', ['uses' => 'MainController@getSchoolDonations', 'as' => 'getSchoolDonations']);
Route::get('/services', ['uses' => 'MainController@getServices', 'as' => 'getServices']);
Route::get('/service/{slug}', ['uses' => 'MainController@getStandAloneService', 'as' => 'getStandAloneService']);
Route::get('/dry-clean',['uses' => 'MainController@getDryClean', 'as' => 'getDryClean']);
Route::get('/wash-n-fold', ['uses' => 'MainController@getWashNFold', 'as' => 'getWashNFold']);
Route::get('/corporate', ['uses' => 'MainController@getCorporate', 'as' => 'getCorporateFront']);
Route::get('/tailoring', ['uses' => 'MainController@getTailoring', 'as' => 'getTailoringFront']);
Route::get('/wet-cleaning', ['uses' => 'MainController@getWetCleaning', 'as' => 'getWetCleaningFront']);
Route::get('/complaints', ['uses' => 'MainController@getComplaints', 'as' => 'getComplaints']);
Route::post('/complaints', ['uses' => 'MainController@postComplaints', 'as' => 'postComplaints']);
Route::post('/last-insterted-record', ['uses' => 'MainController@lastPickUpReq', 'as' => 'lastPickUpReq']);
Route::get('/forgot-password', ['uses' => 'MainController@getForgotPassword', 'as' => 'getForgotPassword']);
Route::post('/forgot-password', ['uses' => 'MainController@postForgotPassword', 'as' => 'postForgotPassword']);
Route::get('/confirm-reset-password/{id}', ['uses' => 'MainController@getResetUserPassword', 'as' => 'getresetUserPassword']);
Route::post('/reset-password-save', ['uses' => 'MainController@postResetPassword', 'as' => 'postResetPassword']);
/*after login user functionality in middleware*/
Route::get('/login', ['uses' => 'MainController@getLogin' ,'as' => 'getLogin']);
Route::post('/login-attempt', ['uses' => 'MainController@postCustomerLogin', 'as' => 'postCustomerLogin']);
Route::post('/save-pickup-request', ['uses' => 'MainController@postPickUp', 'as' => 'postPickUpReq']);
Route::group(['middleware' => ['user']], function () {
    Route::get('/user-dashboard', ['uses' => 'MainController@getDashboard','as' => 'getCustomerDahsboard']);
    Route::get('/profile', ['uses' => 'MainController@getProfile', 'as' => 'get-user-profile']);
    Route::post('/profile', ['uses' => 'MainController@postProfile', 'as' => 'post-user-profile']);
    Route::get('/changepassword', ['uses' => 'MainController@getChangePassword', 'as' => 'getChangePassword']);
    Route::post('/attempt-changepassword', ['uses' => 'MainController@postChangePassword', 'as' => 'postchangePassword']);
    Route::get('/pickup-request', ['uses'=> 'MainController@getPickUpReq', 'as' => 'getPickUpReq']);
    Route::get('/my-pickups', ['uses' => 'MainController@getMyPickUps', 'as' => 'getMyPickUp']);
    Route::post('/delete-pickup', ['uses' => 'MainController@postDeletePickUp', 'as' => 'postDeletePickup']);
    Route::post('/show-invoice', ['uses' => 'InvoiceController@showInvoiceUser', 'as' => 'showInvoiceUser']);
    Route::post('/cancel-order', ['uses' => 'MainController@postCancelOrder', 'as' => 'postCancelOrder']);
});
/*Admin Routes*/
Route::get('/admin', ['uses' => 'AdminController@index', 'as' => 'get-admin-login']);
Route::post('/admin', ['uses' => 'AdminController@LoginAttempt', 'as' => 'post-admin-login']);
//check for session disable back button
Route::post('/check-session', ['uses' => 'AdminController@checkForSession', 'as' => 'checkForSession']);
//session check for back button
Route::group(['middleware' => ['auth']], function () {
    Route::post('/postComplaintsEmailChange', ['uses' => 'AdminController@postComplaintsEmailChange', 'as' => 'postComplaintsEmailChange']);
    Route::post('/postSignUpEmailChange', ['uses' => 'AdminController@postSignUpEmailChange', 'as' => 'postSignUpEmailChange']);
    Route::post('/postIndexWysiwygChange', ['uses' => 'AdminController@postIndexWysiwygChange', 'as' => 'postIndexWysiwygChange']);
    Route::post('/postIndexWysiwygChangeIndexContent', ['uses' => 'AdminController@postIndexWysiwygChangeIndexContent', 'as' => 'postIndexWysiwygChangeIndexContent']);
    Route::post('/postOrderConfirmEmailChange', ['uses' => 'AdminController@postOrderConfirmEmailChange', 'as' => 'postOrderConfirmEmailChange']);
    Route::post('/postForgotPasswordEmailChange', ['uses' => 'AdminController@postForgotPasswordEmailChange', 'as' => 'postForgotPasswordEmailChange']);
    Route::get('/email-templates', ['uses' => 'AdminController@getEmailTemplates', 'as' => 'getEmailTemplates']);
    Route::post('/postDeleteTotalPickUp', ['uses' => 'AdminController@postDeleteTotalPickUp', 'as' => 'postDeleteTotalPickUp']);
	Route::get('/dashboard', ['uses' => 'AdminController@getDashboard', 'as' => 'get-admin-dashboard']);
	Route::get('/logout', ['uses' => 'AdminController@logout', 'as' => 'get-admin-logout']);
	Route::get('/profile-details', ['uses' => 'AdminController@getProfile', 'as' => 'get-admin-profile']);
	Route::post('/profile-details', ['uses' => 'AdminController@postProfile', 'as' => 'post-admin-profile']);
	Route::get('/settings', ['uses' => 'AdminController@getSettings', 'as' => 'get-admin-settings']);
	Route::post('/change-password', ['uses' => 'AdminController@postChangePassword', 'as' => 'post-change-password']);
	Route::post('/site-settings', ['uses' => 'AdminController@postSiteSettings', 'as' => 'post-site-settings']);
	Route::get('/neighborhood', ['uses' => 'AdminController@getNeighborhood', 'as' => 'get-neighborhood']);
	Route::post('/neighborhood', ['uses' => 'AdminController@postNeighborhood', 'as' => 'postneighborhood' ]);
	Route::post('/edit-neighborhood', ['uses' => 'AdminController@editNeighborhood', 'as' => 'editneighborhood']);
	Route::post('/delete-neighborhood', ['uses' => 'AdminController@deleteNeighborhood', 'as' => 'postDeleteNeighborhood']);
	Route::get('/price-list', ['uses' => 'AdminController@getPriceList' , 'as' => 'getPriceList']);
	Route::post('/price-list', ['uses' => 'AdminController@postPriceList', 'as' => 'postPriceList']);
	Route::post('/edit-price-list', ['uses' => 'AdminController@editPriceList', 'as' => 'PostEditPriceList']);
	Route::post('/delete-price-item', ['uses' => 'AdminController@postDeleteItem', 'as' => 'postDeleteItem']);
	Route::post('/add-category', ['uses' => 'AdminController@postCategory', 'as' => 'postCategory']);
	Route::post('/delete-category', ['uses' => 'AdminController@postDeleteCategory', 'as' => 'postDeleteCategory']);
	Route::get('/customers', ['uses' => 'AdminController@getCustomers', 'as' => 'getAllCustomers']);
	Route::get('/edit-customer/{id}', ['uses' => 'AdminController@getEditCustomer', 'as' => 'getEditCustomer']);
	Route::post('/block-user', ['uses' => 'AdminController@postBlockCustomer', 'as' => 'postBlockCustomer']);
	Route::post('/delete-user', ['uses' => 'AdminController@DeleteCustomerNew', 'as'=> 'postDeleteCustomer']);
	Route::post('/edit-customer', ['uses' => 'AdminController@postEditCustomer', 'as' => 'postEditCustomer']);
	Route::get('/add-new-customer', ['uses' => 'AdminController@getAddNewCustomer', 'as' => 'getAddNewCustomers']);
	Route::post('/add-new-customer', ['uses' => 'AdminController@postAddNewCustomer', 'as' => 'postAddNewCustomer']);
	Route::get('/faq' , ['uses' => 'AdminController@getFaq', 'as' => 'getFaq']);
	Route::post('/atempt-add-faq', ['uses' => 'AdminController@postAddFaq', 'as' => 'postAddFaq']);
	Route::post('/edit-faq', ['uses' => 'AdminController@UpdateFaq', 'as' => 'postEditFaq']);
	Route::post('/delete-faq', ['uses' => 'AdminController@DeleteFaq', 'as' => 'postDeleteFaq']);
	Route::get('/customer-orders', ['uses' => 'AdminController@getCustomerOrders', 'as' => 'getCustomerOrders']);
	Route::get('/staffs', ['uses' => 'AdminController@getStaffList', 'as' => 'getStaffList']);
	Route::post('/add-staff', ['uses' => 'AdminController@postAddStaff', 'as' => 'postAddStaff']);
	Route::post('/change-block-status', ['uses' => 'AdminController@postIsBlock', 'as' => 'postIsBlock']);
    Route::post('/changeOrderStatus',['uses' => 'AdminController@changeOrderStatusAdmin', 'as' => 'changeOrderStatusAdmin']);
    Route::post('/save-details-staff', ['uses'=> 'AdminController@postEditDetailsStaff', 'as' => 'postEditDetailsStaff']);
    Route::post('/delete-staff', ['uses' => 'AdminController@postDelStaff', 'as' => 'postDelStaff']);
    Route::post('/change-staff-password', ['uses' => 'AdminController@postChangeStaffPassword', 'as' => 'postChangeStaffPassword']);
    Route::get('/search',['uses' => 'AdminController@getSearchAdmin', 'as' => 'getSearchAdmin']);
    Route::get('/sortby',['uses' => 'AdminController@getSortAdmin','as' => 'sortAdmin']);
    Route::get('/payment', ['uses' => 'PaymentController@getPayment', 'as' => 'getPayment']);
    Route::group(['prefix' => 'cms'], function() {
    	Route::get('/dry-clean', ['uses' => 'AdminController@getCmsDryClean', 'as' => 'getCmsDryClean']);
    	Route::post('/save-dry-clean', ['uses' => 'AdminController@postCmsDryClean', 'as' => 'postCmsDryClean']);
    	Route::get('/wash-n-fold', ['uses' => 'AdminController@getCmsWashNFold', 'as' => 'getCmsWashNFold']);
    	Route::post('/save-wash-n-fold', ['uses' => 'AdminController@postCmsWashNFold', 'as' => 'postCmsWashNFold']);
    	Route::get('/corporate', ['uses' => 'AdminController@getCorporate', 'as' => 'getCorporate']);
    	Route::post('/save-corporate', ['uses' => 'AdminController@postCorpoarte' , 'as' => 'postCorpoarte']);
    	Route::get('/tailoring', ['uses' => 'AdminController@getTailoring', 'as' => 'getTailoring']);
    	Route::post('/save-tailoring', ['uses' => 'AdminController@postTailoring', 'as' => 'postTailoring']);
    	Route::get('/wet-cleaning', ['uses' => 'AdminController@getWetCleaning', 'as' => 'getWetCleaning']);
    	Route::post('/save-wet-cleaning',['uses' => 'AdminController@postWetCleaning', 'as' => 'postWetCleaning']);
        Route::get('/index-page-control', ['uses' => 'AdminController@getCmsIndexPage', 'as' => 'getCmsIndexPage']);
        Route::post('/save-index-content', ['uses' => 'AdminController@postSaveCmsIndex', 'as' => 'postSaveCmsIndex']);
        Route::get('/index-wysiwyg', ['uses' => 'AdminController@showIndexWysiwygControl', 'as' => 'showIndexWysiwygControl']);
    });
    Route::post('/add-item-custom-Admin',['uses' => 'AdminController@addItemCustomAdmin','as'=>'addItemCustomAdmin']);
    Route::get('/pending-payments', ['uses' => 'PaymentController@getManageClientPayment', 'as' => 'getManageClientPayment']);
    Route::get('/manage-school-donations', ['uses' => 'AdminController@getSchoolDonations', 'as' => 'getSchoolDonationsAdmin']);
    Route::post('/save-school', ['uses' => 'AdminController@postSaveSchool', 'as' => 'postSaveSchool']);
    Route::post('/edit-school', ['uses' => 'AdminController@postEditSchool', 'as' => 'postEditSchool']);
    Route::post('/delete-school', ['uses' => 'AdminController@postDeleteSchool', 'as' => 'postDeleteSchool']);
    Route::post('/pay-pending-money', ['uses' => 'AdminController@postPendingMoney', 'as' => 'postPendingMoney']);
    Route::get('/manage-request-no',['uses' => 'AdminController@manageReqNo','as' => 'manageReqNo']);
    Route::post('/changeWeekDayNumber',['uses' => 'AdminController@changeWeekDayNumber','as' => 'changeWeekDayNumber']);
    Route::get('/setSundayToZero',['uses' => 'AdminController@setSundayToZero','as' => 'setSundayToZero']);
    Route::post('/save-school-donation-percentage', ['uses' => 'AdminController@savePercentage', 'as' => 'savePercentage']);
    Route::get('/expenses', ['uses' => 'AdminController@getExpenses', 'as' => 'getExpenses']);
    Route::get('/allocate-pick-up-req', ['uses' => 'AdminController@getPickUpReqAdmin', 'as' =>'getPickUpReqAdmin']);
    Route::post('/set-times', ['uses' => 'AdminController@postSetTime', 'as' => 'postSetTime']);
    Route::post('/set-day-as-close', ['uses' => 'AdminController@setToClose', 'as' => 'setToClose']);
    Route::post('/check-slug-exists', ['uses' => 'AdminController@checkSlugNeighborhood', 'as' => 'checkSlugNeighborhood']);
    Route::get('/generate-coupon', ['uses' => 'AdminController@getCoupon', 'as' => 'getCoupon']);
    Route::post('/save-coupon', ['uses' => 'AdminController@postSaveCoupon', 'as' => 'postSaveCoupon']);
    Route::post('/change-status-coupon', ['uses' => 'AdminController@ChangeStatusCoupon', 'as' => 'ChangeStatusCoupon']);
    Route::post('/delete-coupon', ['uses' => 'AdminController@postDeleteCoupon', 'as' => 'postDeleteCoupon']);
    Route::get('/payment-history', ['uses' => 'AdminController@getPaymentLog', 'as' => 'getPaymentLog']);
    Route::get('/email-template', ['uses' => 'AdminController@getEmailTemplate', 'as' => 'getEmailTemplate']);
    Route::post('/search-by-item', ['uses' => 'AdminController@postSearchSchool', 'as' => 'postSearchSchool']);
    Route::get('/search-of-button', ['uses' => 'AdminController@postSearchByButton', 'as' => 'postSearchByButton']);


    Route::get('/oders-sort-delivered', ['uses' => 'AdminController@orderSortDelivered', 'as' => 'orderSortDelivered']);

    Route::get('/oders-sort-paid', ['uses' => 'AdminController@orderSortPaid', 'as' => 'orderSortPaid']);

    Route::get('/oders-sort-unpaid', ['uses' => 'AdminController@orderSortUnpaid', 'as' => 'orderSortUnpaid']);

    Route::get('/oders-sort-emergency', ['uses' => 'AdminController@orderSortEmergency', 'as' => 'orderSortEmergency']);

    Route::get('/oders-sort-total-price', ['uses' => 'AdminController@orderSortTotalPrice', 'as' => 'orderSortTotalPrice']);

    Route::get('/oders-sort-pick-up-date', ['uses' => 'AdminController@orderSortPickUpDate', 'as' => 'orderSortPickUpDate']);

    Route::get('/oders-sort-create-date', ['uses' => 'AdminController@orderSortCreatedAt', 'as' => 'orderSortCreatedAt']);

});
//invoice routes
    Route::post('/fetch-invoice', ['uses' => 'AdminController@fetchInvoice', 'as' => 'postPickUpId']);
	Route::post('/save-invoice', ['uses' => 'InvoiceController@postInvoice', 'as' => 'postInvoice']);
	Route::post('/delete-invoice', ['uses' => 'InvoiceController@postDeleteInvoice', 'as' => 'postDeleteInvoice']);
    Route::post('/fetch-percentage', ['uses' => 'InvoiceController@fetchPercentageCoupon', 'as' => 'fetchPercentageCoupon']);
    Route::post('/save-extra-item', ['uses' => 'InvoiceController@pushAnItemInVoice', 'as' => 'pushAnItemInVoice']);
    Route::post('/update-extra-item', ['uses' => 'InvoiceController@UpDateExtraItem', 'as'=> 'UpDateExtraItem']);
    Route::post('/deleteItemFromInvoice', ['uses' => 'AdminController@deleteItemFromInvoice', 'as' => 'deleteItemFromInvoice']);
    Route::post('/postDeleteItemByID', ['uses' => 'AdminController@postDeleteItemByID', 'as' => 'postDeleteItemByID']);

    Route::post('/postCancleDeleteItemByID', ['uses' => 'AdminController@postCancleDeleteItemByID', 'as' => 'postCancleDeleteItemByID']);

    Route::post('/is-coupon-valid', ['uses' => 'MainController@checkCouponVailidity', 'as' => 'checkCouponVailidity']);

//mark as paid routes
    Route::post('/mark-as-paid', ['uses' => 'PaymentController@postMarkAsPaid', 'as' => 'postMarkAsPaid']);
    Route::post('/post-payment-keys', ['uses' => 'PaymentController@postPaymentKeys', 'as' => 'postPaymentKeys']);
    Route::post('/payment', ['uses' => 'PaymentController@AuthoRizePayment', 'as' => 'postPayment']);
    Route::post('/fetch-credit-card', ['uses' => 'PaymentController@postGetCustomerCreditCard', 'as' => 'postGetCustomerCreditCard']);
//Staff routes
Route::group (['prefix' => 'staff'], function () {
    Route::get('/login',['uses' => 'StaffController@getStaffLogin','as' => 'getStaffLogin']);
    Route::get('/',['uses' => 'StaffController@getStaffIndex','as' => 'getStaffIndex']);
    Route::get('/orders/{value?}',['uses' => 'StaffController@getStaffOrders', 'as' => 'getStaffOrders']);
    Route::post('/orders',['uses' => 'StaffController@changeOrderStatus', 'as' => 'changeOrderStatus']);
    Route::get('/search',['uses' => 'StaffController@getSearch', 'as' => 'getSearch']);
    Route::post('/login',['uses' => 'StaffController@LoginAttempt', 'as' => 'post-staff-login']);
    Route::get('/logout',['uses' => 'StaffController@getLogout', 'as' => 'getStaffLogout']);
    Route::get('/sort',['uses' => 'StaffController@getSort','as' => 'sort']);
    Route::post('/add-item-custom',['uses' => 'StaffController@addItemCustom','as'=>'addItemCustom']);
    Route::get('/school-donation', ['uses' => 'StaffController@getSchoolDonationStaff', 'as' => 'getSchoolDonationStaff']);
    Route::post('/save-school-donation', ['uses' => 'StaffController@postEditSchoolStaff', 'as' => 'postEditSchoolStaff']);
    Route::post('/delete-school', ['uses' => 'StaffController@postDeleteSchoolStaff', 'as' => 'postDeleteSchoolStaff']);
    Route::post('/pay-pending-money', ['uses' => 'StaffController@postPendingMoneyStaff', 'as' => 'postPendingMoneyStaff']);
    Route::get('/make-payments', ['uses' => 'StaffController@getMakePayments', 'as' => 'getMakePayments']);
    Route::get('/manual-payments', ['uses' => 'StaffController@getManualPayment', 'as' => 'getManualPayment']);
});

//API V.1 routes
Route::group(['prefix' => 'V1'], function () {
    Route::post('/login',['uses' => 'ApiV1\UserApiController@LoginAttempt', 'as' => 'LoginAttempt']);
    Route::post('/order-history',['uses' => 'ApiV1\UserApiController@order_history','as' => 'order_history']);
    Route::post('/place-order',['uses' => 'ApiV1\UserApiController@placeOrder','as' => 'placeOrder']);
    Route::post('/sign-up-user',['uses' => 'ApiV1\UserApiController@userSignUp','as' => 'userSignUp']);
    Route::post('/get-prices',['uses' => 'ApiV1\UserApiController@getPrices', 'as' => 'getPricesApi']);
    Route::post('/get-neighborhoods',['uses' => 'ApiV1\UserApiController@getNeighborhood','as' => 'getNeighborhoodApi']);
    Route::post('/get-faq',['uses' => 'ApiV1\UserApiController@getFaq','as' => 'getFaqApi']);
    Route::post('/contact-us',['uses' => 'ApiV1\UserApiController@contactUs','as' => 'contactUsApi']);
    Route::post('/update-user',['uses' => 'ApiV1\UserApiController@updateProfile','as' => 'updateProfileApi']);
    Route::post('/change-password',['uses' => 'ApiV1\UserApiController@changePassword','as' => 'changePasswordApi']);
    Route::post('/delete-pickup',['uses' => 'ApiV1\UserApiController@deletePickup','as' => 'deletePickupApi']);
    Route::post('/pick-up-types', ['uses' => 'ApiV1\UserApiController@postPickUpType', 'as' => 'postPickUpType']);
    Route::post('/school-lists', ['uses' => 'ApiV1\UserApiController@postSchoolLists', 'as' => 'postSchoolLists']);
    Route::post('/get-services', ['uses' => 'ApiV1\UserApiController@postServicesApi', 'as' => 'postServicesApi']);
    Route::post('/check-email', ['uses' => 'ApiV1\UserApiController@checkEmail', 'as' => 'checkEmail']);
    Route::post('/get-user-details',['uses' => 'ApiV1\UserApiController@userDetails','as' => 'userDetails']);
    Route::post('/social-login',['uses' => 'ApiV1\UserApiController@social_Login','as' => 'social_Login']);
    Route::post('/order-tracker',['uses' => 'ApiV1\UserApiController@getOrderTracker','as' => 'getOrderTracker']);
    Route::post('/get-pickup-times', ['uses' => 'ApiV1\UserApiController@getPickUpTimes', 'as' => 'getPickUpTimes']);
    Route::post('/get-school-preferences', ['uses' => 'ApiV1\UserApiController@showSchoolPreferences', 'as' => 'showSchoolPreferences']);
    Route::post('/add-school-preferences', ['uses' => 'ApiV1\UserApiController@addSchoolToPreference', 'as' => 'addSchoolToPreference']);
    Route::post('/get-card-details', ['uses' => 'ApiV1\UserApiController@getCreditCardDetails', 'as' => 'getCreditCardDetails']);
    Route::post('/cancle-order', ['uses' => 'ApiV1\UserApiController@cancleOrder', 'as' => 'cancleOrder']);

    Route::post('/postForgotPassword', ['uses' => 'ApiV1\UserApiController@postForgotPassword', 'as' => 'postForgotPasswordApi']);
    Route::post('/postCoupon', ['uses' => 'ApiV1\UserApiController@checkCoupon', 'as' => 'checkCoupon']);

}); 