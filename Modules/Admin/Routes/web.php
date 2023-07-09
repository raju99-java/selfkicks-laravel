<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::prefix('admin')->group(function() {

    Route::get('clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return "Cache,View is cleared";
    });



    Route::middleware(['admin_not_logged_in'])->group(function () {
        Route::get('/', 'AuthController@get_login');
        Route::get('admin-login', ['uses' => 'AuthController@get_login', 'as' => 'admin-login']);
        Route::post('admin-login', ['uses' => 'AuthController@post_login', 'as' => 'admin-login']);
        Route::get('admin-lockscreen', ['uses' => 'AuthController@get_lockscreen', 'as' => 'admin-lockscreen']);
        Route::post('admin-lockscreen', ['uses' => 'AuthController@post_lockscreen', 'as' => 'admin-lockscreen']);
    });

    Route::middleware(['admin_logged_in'])->group(function () {

        Route::get('admin-dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin-dashboard']);
        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);
        Route::get('admin-profile', ['uses' => 'DashboardController@get_profile', 'as' => 'admin-profile']);
        Route::post('admin-profile', ['uses' => 'DashboardController@post_profile', 'as' => 'admin-profile']);


        Route::get('admin-change-password', ['uses' => 'DashboardController@get_change_password', 'as' => 'admin-change-password']);
        Route::post('admin-change-password', ['uses' => 'DashboardController@post_change_password', 'as' => 'admin-change-password']);
        Route::get('user-change-image', ['uses' => 'DashboardController@get_change_image', 'as' => 'user-change-image']);
        Route::post('user-change-image', ['uses' => 'DashboardController@post_change_image', 'as' => 'user-change-image']);


        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);

        Route::get('settings', ['uses' => 'SettingsController@index', 'as' => 'settings']);
        Route::post('settings', ['uses' => 'SettingsController@store', 'as' => 'settings']);

        Route::get('login-history', ['uses' => 'LoginHistoryController@index', 'as' => 'login-history']);
        Route::get('login-history-list', ['uses' => 'LoginHistoryController@get_list', 'as' => 'login-history-list']);

        Route::get('emailNotification', ['uses' => 'EmailNotificationController@index', 'as' => 'emailNotification']);
        Route::get('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@get_edit', 'as' => 'emailNotification-edit']);
        Route::post('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@post_edit', 'as' => 'emailNotification-edit']);
        Route::get('emailNotification-list', ['uses' => 'EmailNotificationController@get_list', 'as' => 'emailNotification-list']);
        Route::get('emailNotification', ['uses' => 'EmailNotificationController@index', 'as' => 'emailNotification']);
        Route::get('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@get_edit', 'as' => 'emailNotification-edit']);
        Route::post('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@post_edit', 'as' => 'emailNotification-edit']);

        

       
        
        Route::resource('static-page', 'StaticpageController');

        Route::get('cms', ['uses' => 'CmsController@index', 'as' => 'cms']);
        Route::get('cms-list', ['uses' => 'CmsController@get_list', 'as' => 'cms-list']);
        Route::get('cms-edit/{id}', ['uses' => 'CmsController@get_edit', 'as' => 'cms-edit']);
        Route::post('cms-edit/{id}', ['uses' => 'CmsController@post_edit', 'as' => 'cms-edit']);

        Route::get('cmspage', ['uses' => 'CmspageController@index', 'as' => 'cmspage']);
        Route::get('cmspage-list', ['uses' => 'CmspageController@get_list', 'as' => 'cmspage-list']);
        Route::get('cmspage-edit/{id}', ['uses' => 'CmspageController@get_edit', 'as' => 'cmspage-edit']);
        Route::post('cmspage-edit/{id}', ['uses' => 'CmspageController@post_edit', 'as' => 'cmspage-edit']);


        Route::get('/notification/datatables', 'NotificationController@datatables')->name('admin-notification-datatables'); //JSON REQUEST
        Route::get('/notification', 'NotificationController@index')->name('admin-notification-index');
        Route::get('/notification/create', 'NotificationController@create')->name('admin-notification-create');
        Route::post('/notification/create', 'NotificationController@store')->name('admin-notification-store');
        Route::get('/notification/edit/{id}', 'NotificationController@edit')->name('admin-notification-edit');
        Route::post('/notification/edit/{id}', 'NotificationController@update')->name('admin-notification-update');
        Route::post('/notification/delete/{id}', 'NotificationController@destroy')->name('admin-notification-delete');
        
        
        Route::post('/upload/ckeditor', 'CkeditorController@upload_ckeditor')->name('admin-upload-ckeditor');

        Route::get('subscription/datatables', 'PlanController@datatables')->name('subscription-datatables'); //JSON REQUEST
        Route::get('subscription', 'PlanController@index')->name('subscription');
        Route::get('subscription-add', 'PlanController@get_add')->name('subscription-add');
        Route::post('subscription-add', 'PlanController@post_add')->name('subscription-add');
        Route::get('subscription-edit/{id}', 'PlanController@get_edit')->name('subscription-edit');
        Route::post('subscription-edit/{id}', 'PlanController@post_edit')->name('subscription-edit');
        Route::get('subscription-delete/{id}', 'PlanController@delete')->name('subscription-delete');


        Route::get('user', ['uses' => 'UserController@get_user_list', 'as' => 'user']);
        Route::get('user-list-datatable', ['uses' => 'UserController@get_user_list_datatable', 'as' => 'user-list-datatable']);
        Route::get('user-edit/{id}', ['uses' => 'UserController@get_edit_user', 'as' => 'user-edit']);
        Route::put('user-edit/{id}', ['uses' => 'UserController@post_edit_user', 'as' => 'user-edit']);
        Route::post('user-delete/{id}', ['uses' => 'UserController@delete', 'as' => 'user-delete']);


        Route::get('normal-member', ['uses' => 'NormalMemberController@get_user_list', 'as' => 'normal-member']);
        Route::get('normal-member-list-datatable', ['uses' => 'NormalMemberController@get_user_list_datatable', 'as' => 'normal-member-list-datatable']);
        Route::get('normal-member-edit/{id}', ['uses' => 'NormalMemberController@get_edit_user', 'as' => 'normal-member-edit']);
        Route::put('normal-member-edit/{id}', ['uses' => 'NormalMemberController@post_edit_user', 'as' => 'normal-member-edit']);
        Route::post('normal-member-delete/{id}', ['uses' => 'NormalMemberController@delete', 'as' => 'normal-member-delete']);


        Route::get('premium-member', ['uses' => 'PremiumMemberController@get_user_list', 'as' => 'premium-member']);
        Route::get('premium-member-list-datatable', ['uses' => 'PremiumMemberController@get_user_list_datatable', 'as' => 'premium-member-list-datatable']);
        Route::get('premium-member-edit/{id}', ['uses' => 'PremiumMemberController@get_edit_user', 'as' => 'premium-member-edit']);
        Route::put('premium-member-edit/{id}', ['uses' => 'PremiumMemberController@post_edit_user', 'as' => 'premium-member-edit']);
        Route::post('premium-member-delete/{id}', ['uses' => 'PremiumMemberController@delete', 'as' => 'premium-member-delete']);

        Route::get('/slider/datatables', 'SliderController@datatables')->name('admin-slider-datatables'); //JSON REQUEST
        Route::get('/slider', 'SliderController@index')->name('admin-slider-index');
        Route::get('/slider/create', 'SliderController@create')->name('admin-slider-create');
        Route::post('/slider/create', 'SliderController@store')->name('admin-slider-store');
        Route::get('/slider/edit/{id}', 'SliderController@edit')->name('admin-slider-edit');
        Route::post('/slider/edit/{id}', 'SliderController@update')->name('admin-slider-update');
        Route::post('/slider/delete/{id}', 'SliderController@destroy')->name('admin-slider-delete');

        Route::get('kyc-request-list', ['uses' => 'KycRequestController@get_kyc_equest_list', 'as' => 'kyc-request-list']);
        Route::get('kyc-request-datatable', ['uses' => 'KycRequestController@get_kyc_request_datatable', 'as' => 'kyc-request-datatable']);
        Route::get('kyc-request/{id}', ['uses' => 'KycRequestController@get_kyc_request', 'as' => 'kyc-request']);
        Route::put('kyc-request/{id}', ['uses' => 'KycRequestController@post_kyc_request', 'as' => 'kyc-request']);

        Route::get('plan-history-list', ['uses' => 'PlanHistoryController@get_history_list', 'as' => 'plan-history-list']);
        Route::get('plan-history-datatable', ['uses' => 'PlanHistoryController@get_history_datatable', 'as' => 'plan-history-datatable']);


        Route::get('video/datatables', 'VideoController@datatables')->name('video-datatables'); //JSON REQUEST
        Route::get('video', 'VideoController@index')->name('video');
        Route::get('video-add', 'VideoController@get_add')->name('video-add');
        Route::post('video-add', 'VideoController@post_add')->name('video-add');
        Route::get('video-edit/{id}', 'VideoController@get_edit')->name('video-edit');
        Route::post('video-edit/{id}', 'VideoController@post_edit')->name('video-edit');
        Route::post('video-delete/{id}', 'VideoController@delete')->name('video-delete');

        Route::get('prime-video/datatables', 'PrimeVideoController@datatables')->name('prime-video-datatables'); //JSON REQUEST
        Route::get('prime-video', 'PrimeVideoController@index')->name('prime-video');
        Route::get('prime-video-add', 'PrimeVideoController@get_add')->name('prime-video-add');
        Route::post('prime-video-add', 'PrimeVideoController@post_add')->name('prime-video-add');
        Route::get('prime-video-edit/{id}', 'PrimeVideoController@get_edit')->name('prime-video-edit');
        Route::post('prime-video-edit/{id}', 'PrimeVideoController@post_edit')->name('prime-video-edit');
        Route::post('prime-video-delete/{id}', 'PrimeVideoController@delete')->name('prime-video-delete');

        Route::get('enquiry', ['uses' => 'EnquiryController@get_enquiry_list', 'as' => 'enquiry']);
        Route::get('enquiry-list-datatable', ['uses' => 'EnquiryController@get_enquiry_list_datatable', 'as' => 'enquiry-list-datatable']);
        Route::get('enquiry-view/{id}', ['uses' => 'EnquiryController@get_view', 'as' => 'enquiry-view']);
        Route::post('enquiry-delete/{id}', ['uses' => 'EnquiryController@delete', 'as' => 'enquiry-delete']);

        Route::get('earning-points', ['uses' => 'EarningPointController@get_earning_points_list', 'as' => 'earning-points']);
        Route::get('earning-points-list-datatable', ['uses' => 'EarningPointController@get_earning_points_list_datatable', 'as' => 'earning-points-list-datatable']);
      
        Route::get('redeem', ['uses' => 'RedeemController@get_redeem_list', 'as' => 'redeem']);
        Route::get('redeem-list-datatable', ['uses' => 'RedeemController@get_redeem_list_datatable', 'as' => 'redeem-list-datatable']);
        Route::post('redeem-reject/{id}', ['uses' => 'RedeemController@reject', 'as' => 'redeem-reject']);
        Route::post('redeem-accept/{id}', ['uses' => 'RedeemController@accept', 'as' => 'redeem-accept']);
        Route::post('redeem-delete/{id}', ['uses' => 'RedeemController@delete', 'as' => 'redeem-delete']);

    });
});
