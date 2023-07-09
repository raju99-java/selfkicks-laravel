@extends('layouts.main')

@section('content')

    <!------ inner body ------>
        
        <!---------bradecrumbs ---->
        <div class="custombreadcrumbs">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content">
                            <h1>Account</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content-menu">
                            <ul class="list-unstyled">
                                <li class="list-inline-item"><a href="{{route('/')}}">Home</a></li>
                                <li class="list-inline-item"><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                                <li class="list-inline-item">Account</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------//bradecrumbs ---->
        
        <!------ user dashboard ---->
        <section class="dashboard-bg-area mt-4 mb-4">
            <div class="container-fluid">
                <div class="dashboard-bg">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <div class="user-profile text-center">
                                <div class="profile-img">
                                    <img src="{{ ($user->image != '')? URL::asset('public/uploads/user').'/'.$user->image : URL::asset('public/frontend/img/user-avatar.png')}}" class="img-fluid img-rounded" alt="User Avatar">
                                </div>
                                <div class="profile-content">
                                    <h4>{{$user->full_name}}</h4>
                                    <p>{{$user->email}}</p>  
                                </div>
                                <div class="mt-3">
                                    <a href="{{route('my-profile')}}" class="vfx-item-btn-danger text-uppercase"><i class="fa fa-edit"></i> Edit</a>
                                    @if($user->kyc_verified == '0')
                                        <a href="{{route('kyc-details')}}" class="vfx-item-btn-danger text-uppercase"><i class="fa fa-shield"></i> KYC Details</a>
                                    @elseif($user->kyc_verified == '1')
                                        <a href="{{route('kyc-details')}}" class="vfx-item-btn-danger text-uppercase"><i class="fa fa-spinner"></i> KYC Details</a>
                                    @else
                                        <a href="{{route('kyc-details')}}" class="vfx-item-btn-danger text-uppercase"><i class="fa fa-check-circle-o"></i> KYC Details</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <div class="member-ship-option">
                                <h5 class="color-up">My Subscription</h5>
                                <span class="premuim-memplan-bold-text"><strong>Current Plan:</strong>
                                    @if($user->subcription_id == '0')
                                        <span>{{$user->subscription->name}}</span>
                                    @elseif($user->subcription_id == '1')
                                        <span>{{$user->subscription->name}}</span>
                                    @elseif($user->subcription_id == '2')
                                        <span>{{$user->subscription->name}}</span>
                                    @endif
                                </span>
                                <span class="premuim-memplan-bold-text"><strong>expires on:</strong>
                                    <span>{{($user->days_left == '') ? 'NA' :  App\Http\Controllers\Controller::expiry_date($user->days_left)}}</span>
                                </span>
                                <div class="mt-3">
                                    
                                    @if($user->subcription_id == '0')
                                        <a href="{{route('subscription-plan')}}" class="vfx-item-btn-danger text-uppercase">
                                            <span>Purchase Plan</span>
                                        </a>
                                    @elseif($user->premium_member == '0')
                                        <a href="{{route('subscription-plan')}}" class="vfx-item-btn-danger text-uppercase">
                                            <span>Upgrade Plan</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($user->subscription->earning_point == '1')
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <div class="member-ship-option">
                                <h5 class="color-up">Earning Point</h5>
                                <span class="premuim-memplan-bold-text"><strong>Total Point:</strong><span>{{$user->total_points}}</span></span>
                                <span class="premuim-memplan-bold-text"><strong>Earning History:</strong><span><a href="{{route('point-history')}}" ><i class="fa fa-history" aria-hidden="true"></i></a></span></span>

                                @if($user->total_points >= $redeem->value)
                                    <div class="mt-3">
                                        @csrf
                                        <a href="javascript:;" onclick="redeemRequest(this)" data-id="{{base64_encode(Auth::guard('frontend')->user()->id)}} class="vfx-item-btn-danger text-uppercase">Redeem</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($user->subscription->referral_status == '1')
                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <div class="member-ship-option">
                                <h5 class="color-up">my referral code</h5>
                                <span class="premuim-memplan-bold-text"><strong>Code:</strong>
                                    <span>{{($user->referral_code != '') ? $user->referral_code : 'NA'}}</span>
                                </span>
                            </div>
                        </div> 
                        @endif   
                    </div>
                </div>    
            </div>                
        </section>

        <section class="table-div">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12">
                        <div class="table-wrapper">
                            <div class="table-title-section">
                                <h3>Subscription History</h3>           
                            </div>
                            <div style="overflow: auto;">
                                <table class="table table-striped table-dark table-hover table-bordered my-table mt-3 mb-5">
                                    <thead class="custom-head">
                                      <tr>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Amount</th>
                                        
                                        <th scope="col">Payment ID</th>
                                        <th scope="col">Payment Date</th>
                                        <th scope="col">Validity</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        
                                            @forelse($plan_history as $history)
                                                <tr>
                                                    <th scope="row"><span class="current-plan-item">{{$history->subscription->name}}</span></th>
                                                    <td>₹ {{$history->amount}}.00</td>
                                                    <td>{{$history->txnid}}</td>
                                                    <td><span class="expires-plan-item">{{date('jS M Y', strtotime($history->created_at))}}</span></td>
                                                    <td><span class="expires-plan-item">{{App\Http\Controllers\Controller::expiry_date($history->user->days_left)}}</span></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <p style="text-align:center;"><span class="current-plan-item">No Data Found!</span></p>
                                                    </td>
                                                    
                                                </tr>
                                            @endforelse
                                       
                                      
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!------// user dashboard -->

        
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->
    <!------ inner body ------>
    
@stop

@section('page_js')


@endsection
