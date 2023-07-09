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



Route::middleware(['prevent_back_history'])->group(function (){

    Route::middleware(['web'])->group(function () {
        Route::get('', ['uses' => 'SiteController@index', 'as' => 'index']);
        Route::get('/', ['uses' => 'SiteController@index', 'as' => '/']);
        Route::get('index', ['uses' => 'SiteController@index', 'as' => 'index']);
    
        Route::get('about-us', ['uses' => 'SiteController@about_us', 'as' => 'about-us']);

        Route::get('contact-us', ['uses' => 'SiteController@contact_us', 'as' => 'contact-us']);
        Route::post('contact-us', ['uses' => 'SiteController@post_contact_us', 'as' => 'contact-us']);

        Route::get('thank-you', ['uses' => 'SiteController@thank_you', 'as' => 'thank-you']);
        Route::get('faq', ['uses' => 'SiteController@get_faq', 'as' => 'faq']);
        Route::get('investors', ['uses' => 'SiteController@get_investors', 'as' => 'investors']);
        Route::get('terms-conditions', ['uses' => 'SiteController@terms_conditions', 'as' => 'terms-conditions']);
        Route::get('privacy-policy', ['uses' => 'SiteController@privacy_policy', 'as' => 'privacy-policy']);
        Route::get('return-refund-policy', ['uses' => 'SiteController@return_refund_policy', 'as' => 'return-refund-policy']);
          
    });

    Route::middleware(['user_not_logged_in'])->group(function () {
    
        Route::post('get-started', 'SiteController@post_started')->name('get-started');
        
        Route::get('signup', 'SiteController@get_signup')->name('signup');
        Route::post('signup', 'SiteController@post_signup')->name('signup');

        Route::post('verify-otp', 'SiteController@post_verify_otp')->name('verify-otp');

        Route::get('resend-otp', 'SiteController@resend_otp')->name('resend-otp');
        
        Route::get('login', 'SiteController@get_login')->name('login');
        Route::post('login', 'SiteController@post_login')->name('login');

        
        Route::get('forgot-password', 'SiteController@get_forgot_password')->name('forgot-password');
        Route::post('forgot-password', 'SiteController@post_forgot_password')->name('forgot-password');
        Route::get('forgot-resend-otp', 'SiteController@forgot_resend_otp')->name('forgot-resend-otp');
        Route::post('forgot-verify-otp', 'SiteController@post_forgot_verify_otp')->name('forgot-verify-otp');


        Route::get('reset-password/{email}/{otp}', 'SiteController@get_reset_password')->name('reset-password');
        Route::post('set-password', 'SiteController@post_reset_password')->name('set-password');
        
        
    });
    Route::middleware(['user_logged_in'])->group(function () {
        
        Route::get('dashboard', 'UserController@get_dashboard')->name('dashboard');

        Route::get('video-details/{id}', 'UserController@get_video_details')->name('video-details');

        Route::post('watch-video', 'UserController@post_watch_video')->name('watch-video'); // watch video

        Route::get('watch-list', 'UserController@get_watch_list')->name('watch-list');
        Route::post('add-watch-list', 'UserController@post_add_watch_list')->name('add-watch-list');
        Route::post('remove-watch-list', 'UserController@post_remove_watch_list')->name('remove-watch-list');

        Route::get('account', 'UserController@get_account')->name('account');

        Route::get('my-profile', 'UserController@get_profile')->name('my-profile');
        Route::post('my-profile', 'UserController@post_profile')->name('my-profile');

        Route::get('kyc-details', 'UserController@get_kyc_details')->name('kyc-details');
        Route::post('kyc-details', 'UserController@post_kyc_details')->name('kyc-details');

        Route::get('subscription-plan', 'UserController@get_subscription_plan')->name('subscription-plan');

        Route::get('payment-method/{id}', 'UserController@get_payment_method')->name('payment-method');
        Route::post('plan-payment-method', 'UserController@post_payment_method')->name('plan-payment-method');

        Route::post('success-subscription/{id}', 'UserController@post_success_subscription')->name('success-subscription');
        Route::post('cancel-subscription/{id}', 'UserController@cancel_subscription')->name('cancel-subscription');

        Route::get('point-history', 'UserController@get_point_history')->name('point-history');
        Route::post('redeem-request', 'UserController@post_redeem_request')->name('redeem-request');

        Route::get('logout', 'UserController@logout')->name('logout');
        
    });

});