@extends('admin::layouts.main')

@section('content')

@php
use Illuminate\Support\Str;
@endphp
<div class="clearfix">
    <div class="dash-bottom-part">
        <div class="bottom-part-1">
            <div class="col-sm-12">
                <h1 class="dash_heading">DASHBOARD</h1>
                <div class="row">

                    
                  
                  	
                    <!-- <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('admin-notification-index')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-bell dashboard-icon" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_notification)?$total_notification:'0'}}</h1>
                                        <h2>TOTAL NOTIFICATION</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div> -->

                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('admin-slider-index')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_slider)?$total_slider:'0'}}</h1>
                                        <h2>TOTAL SLIDERS</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('enquiry')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-question" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_enq)?$total_enq:'0'}}</h1>
                                        <h2>TOTAL ENQUIRY</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('video')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_video)?$total_video:'0'}}</h1>
                                        <h2>TOTAL VIDEOS</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('prime-video')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_prime_video)?$total_prime_video:'0'}}</h1>
                                        <h2>TOTAL PRIME VIDEOS</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('user')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_user)?$total_user:'0'}}</h1>
                                        <h2>TOTAL USERS</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('normal-member')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_member)?$total_member:'0'}}</h1>
                                        <h2>NORMAL MEMBERS</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('premium-member')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_premium_member)?$total_premium_member:'0'}}</h1>
                                        <h2>PREMIUM MEMBERS</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('subscription')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="icofont-brand-axiata" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_plan)?$total_plan:'0'}}</h1>
                                        <h2>TOTAL SUBSCRIPTION PLANS</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('kyc-request-list')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-shield" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_kyc_req)?$total_kyc_req:'0'}}</h1>
                                        <h2>TOTAL KYC REQUEST</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('plan-history-list')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-shield" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_plan_hist)?$total_plan_hist:'0'}}</h1>
                                        <h2>TOTAL SUBSCRIPTION HISTORY</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('earning-points')}}">
                            <div class="inner-box gradient-bg-1 d-flex align-items-center">
                                <div class="media align-items-center">
                                  	<div class="media-right right-padding">
                                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_earn)?$total_earn:'0'}}</h1>
                                        <h2>TOTAL POINTS HISTORY</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>


                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop