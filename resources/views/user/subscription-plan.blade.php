@extends('layouts.main')

@section('content')


        
        <!---------bradecrumbs ---->
        <div class="custombreadcrumbs">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content">
                            <h1>Subscription Plan</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content-menu">
                            <ul class="list-unstyled">
                                <li class="list-inline-item"><a href="{{route('/')}}">Home</a></li>
                                <li class="list-inline-item"><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                                <li class="list-inline-item">Subscription Plan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------//bradecrumbs ---->
        
        <!------ user dashboard ---->
        <section class="dashboard-bg-area mt-5 mb-5">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">

                
                    @forelse($subscriptions as $subscription)
                        <div class="col-md-12 col-sm-12 col-lg-3 col-xl-3">
                            <div class="membership-plan-list">
                                <h3>{{$subscription->name}}</h3>
                                <h1><span>₹</span>{{$subscription->price}}<sub style="bottom:0px;">.00</sub></h1>
                                <p></p>
                                <h4>{{$subscription->validity}} Day(s)</h4>

                                {!! $subscription->details !!}

                                @if($user->subcription_id == 0)
                                    <a href="{{route('payment-method',base64_encode($subscription->id))}}" class="vfx-item-btn-danger text-uppercase mb-30" title="plan">Select Plan</a>
                                @else
                                    @if($user->subcription_id == $subscription->id)
                                        <a href="#" class="vfx-item-btn-danger text-uppercase mb-30" title="plan">Your Current Plan</a>
                                    @else
                                        <a href="{{route('payment-method',base64_encode($subscription->id))}}" class="vfx-item-btn-danger text-uppercase mb-30" title="plan">Select Plan</a>
                                    @endif
                                @endif
                            </div> 
                        </div>
                        @empty
                    @endforelse

                

                    <!-- <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                        <div class="apply-coupon-code">
                            <h2>I Have Coupon Code</h2>
                            <form method="POST" action="#" role="form">
                                <div class="apply-now-item"> 
                                    <input type="text" name="coupon_code" id="enterCode" class="form-control" placeholder="" required="">
                                    <button class="vfx-item-btn-danger text-uppercase" type="submit">Apply Coupon</button> 
                                </div>
                            </form>  
                        </div>
                    </div>     -->
                </div>    
            </div>                
        </section>
        <!------// user dashboard -->

        
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->
        
@stop

@section('page_js')


@endsection