<?php

    $PAYU_BASE_URL = $BASE_URL;
    $action = '';
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    $posted = array();
    $posted = array(
        'key' => $MERCHANT_KEY,
        'txnid' => $txnid,
        'amount' => '',
        'firstname' => 'Raju Debnath',
        'email' => 'albert@yopmail.com',
        'productinfo' => 'Plan fee',
        'surl' => 'http://localhost/self-kicks/',
        'furl' => 'http://localhost/self-kicks/',
        'service_provider' => 'payu_paisa',
    );

    if (empty($posted['txnid'])) {
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    } else {
        $txnid = $posted['txnid'];
    }
    $hash = '';
    $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    if (empty($posted['hash']) && sizeof($posted) > 0) {
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach ($hashVarsSeq as $hash_var) {
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }
        $hash_string .= $SALT;
        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
    } elseif (!empty($posted['hash'])) {
        $hash = $posted['hash'];
        $action = $PAYU_BASE_URL . '/_payment';
    }
?>

@extends('layouts.main')

@section('content')
        
        <!---------bradecrumbs ---->
        <div class="custombreadcrumbs">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content">
                            <h1>Payment Method</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content-menu">
                            <ul class="list-unstyled">
                                <li class="list-inline-item"><a href="{{route('/')}}">Home</a></li>
                                <li class="list-inline-item"><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                                <li class="list-inline-item">Payment Method</li>
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
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 offset-lg-2 offset-md-0">
                        <div class="payment dashboard-bg">
                            <h5 class="color-up">Payment Method</h5>
                            <div>
                                <span class="premuim-memplan-bold-text"><strong>You have Selected:</strong><span> {{$plan->name}}</span></span>
                            </div>
                            <div>
                                <span class="premuim-memplan-bold-text"><strong>Price:</strong><span> ₹ {{$plan->price}}/-</span></span>
                            </div>
                            <div>
                                <span class="premuim-memplan-bold-text"><strong>Validity:</strong><span> {{$plan->validity}} Day(s)</span></span>
                            </div>
                            <div>
                                <span class="premuim-memplan-bold-text"><strong>Referral Code:</strong>
                                    <span> {{($plan->referral_status == '1') ? 'Available' : 'NA'}} </span>
                                </span>
                            </div>
                            <div>
                                <span class="premuim-memplan-bold-text"><strong>Earning Points to Wath Videos:</strong>
                                    <span> {{($plan->earning_point == '1') ? 'Available' : 'NA'}} </span>
                                </span>
                            </div>
                            <div class="button mt-4">
                                <a href="{{route('subscription-plan')}}" class="vfx-item-btn-danger text-uppercase">Change Plan</a>
                            </div>  

                            <div class="plan-payment">
                                <form id="plan-payment-form" class="custom-form" action="{{route('plan-payment-method')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="plan_id"  value="{{$plan->id}}" >
                                    <div class="form-group user-btn">
                                        <input type="submit" value="Make Payment" class="plan-pay-btn vfx-item-btn-danger text-uppercase">
                                    </div>
                                </form>
                            <div>
                            
                            <form action="<?php echo $action; ?>" method="post" name="payuForm">
                                @csrf
                                <input type="hidden" name="key"  value="<?php echo $MERCHANT_KEY ?>" />
                                <input type="hidden" name="hash" id="hash" value="<?php echo $hash ?>"/>
                                <input type="hidden" name="txnid" id="txnid" value="<?php echo $txnid ?>" />
                                <input type="hidden" name="amount" id="amount" value="" /><br />
                                <input type="hidden" name="firstname" id="firstname" value="Raju Debnath" />
                                <input type="hidden" name="email" id="email" value="albert@yopmail.com" />
                                <input type="hidden" name="phone" id="phone" value=""/>
                                <input type="hidden" name="productinfo" value="Plan fee">
                                <input type="hidden" name="surl" id="surl" value="" />
                                <input type="hidden" name="furl" id="furl" value="" />
                                <input type="hidden" name="service_provider" value="payu_paisa" />
                                <?php if (!$hash) { ?>
                                    <input type="submit" value="Submit" />
                                <?php } ?>
                            </form>
                            
                        </div> 
                    </div>  
                </div>    
            </div>                
        </section>
        <!------// user dashboard -->

        
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->
        
@stop

@section('js')

<script>

    function submitPayuForm() {
        var hash = $('input[name=hash]').val();
        if (hash == '') {
            return;
        }
        var payuForm = document.forms.payuForm;
        payuForm.submit();
    }
</script>

@endsection