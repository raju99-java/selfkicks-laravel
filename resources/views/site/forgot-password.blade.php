@extends('layouts.main')

@section('content')


    <!-- forgot password page body -->
    <div class="section-body custom-form-boby-upper-gap forgotpassword">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6 offset-sm-3">
                    <div class="inner-white-body form-gapping">
                        <div class="form-heading p-top20 p-bottom20">
                            <h1 class="custom-black-title">
                              Forgot Password
                            </h1>
                            <p class="text-black-50">We will send you an email with instructions on how to reset your password.</p>
                        </div>
                        <form id="forgot-form" class="custom-form" action="{{route('forgot-password')}}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="formRow">
                                        <div class="formRow--item">
                                            <label for="emailid" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="text" name="email" class="formRow--input js-input form-control black-input-box" id="emailid" placeholder="Enter Your Email ID">
                                            </label>
                                            <span class="help-block" id="error-email">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <!-- <button type="button" class="btn submit-button" data-toggle="modal" data-target="#forgotModalBtn">CONTINUE</button> -->
                                        <input type="submit" value="CONTINUE" class="btn submit-button">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!-- forgot password page body -->

  <!------ inner body ------>
  

  <!---------- popup area -------------->
  <div class="modal fade" id="forgotModalBtn" tabindex="-1" role="dialog" aria-labelledby="forgotModalBtnLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content custom-modal-body">
        <div class="modal-header modal-custom-header">
          <h5 class="modal-title modal-custom-title" id="forgotModalBtnLabel">Continue With OTP</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="cross">
                <i class="icofont-close-circled"></i>
            </span>
          </button>
        </div>
        <div class="modal-body">

          <form id="forgot-verify-otp-form" class="custom-form" action="{{route('forgot-verify-otp')}}" method="post">
            @csrf
            <div class="row">

                <div class="col-sm-12">
                    <div class="formRow">
                        <div class="formRow--item">
                            <label for="otpid" class="formRow--input-wrapper js-inputWrapper">
                                <input type="text" name="verification_otp" class="formRow--input js-input form-control black-input-box" id="otpid" placeholder="Enter Your OTP Here">
                            </label>
                            <span class="help-block" id="error-verification_otp">{{ $errors->first('verification_otp') }}</span>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <a href="{{route('forgot-resend-otp')}}" id="forgot-resend-otp" class="resend-otp"> Resend OTP </a>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn submit-button">
                    </div>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!----------// popup area -------------->
  
  

@stop

@section('page_js')


@endsection