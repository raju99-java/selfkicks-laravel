@extends('layouts.main')

@section('content')
   
  <!------ inner body ------>
  

    <!-- registration page body -->
    <div class="section-body custom-form-boby-upper-gap registration">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6 offset-sm-3">
                    <div class="inner-login-body form-gapping">
                        <div class="form-heading p-top20 p-bottom20">
                            <h1 class="custom-white-title">
                              Welcome back!
                            </h1>
                            <h2 class="custom-white-title"> 
                              Joining Selfkicks is easy.
                            </h2> 
                            <p>Enter your password and you'll be watching in no time.</p>
                        </div>
                        <form id="signup-form" class="custom-form" action="{{route('signup')}}" method="post">
                          @csrf

                            <div class="row">

                                    <div class="col-sm-12">
                                      <div class="formRow">
                                          <div class="formRow--item">
                                              <label for="full_nameid" class="formRow--input-wrapper js-inputWrapper">
                                                  <input type="text" name="full_name" class="formRow--input js-input form-control black-input-box" id="full_nameid" placeholder="Your Name">
                                              </label>
                                              <span class="help-block" id="error-full_name">{{ $errors->first('full_name') }}</span>
                                          </div>
                                      </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <label for="emailid" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="text" name="email" class="formRow--input js-input form-control black-input-box" id="emailid" placeholder="Email ID" value="<?php
                                                                if (isset($_COOKIE['started_email']) && $_COOKIE['started_email'] !== NULL) {
                                                                    echo $_COOKIE['started_email'];
                                                                }
                                                                ?>" >
                                                </label>
                                                <span class="help-block" id="error-email">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <label for="phoneid" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="text" name="phone" class="formRow--input js-input form-control black-input-box" id="phoneid" placeholder="Your Phone No">
                                                </label>
                                                <span class="help-block" id="error-phone">{{ $errors->first('phone') }}</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <label for="passwordid" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="password" name="password" class="formRow--input js-input form-control black-input-box" id="passwordid" placeholder="Your password">
                                                </label>
                                                <span class="help-block" id="error-password">{{ $errors->first('password') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <label for="referral_codeid" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="text" name="referral_code" class="formRow--input js-input form-control black-input-box" id="referral_codeid" placeholder="Enter Referral Code">
                                                </label>
                                                <span class="help-block" id="error-referral_code">{{ $errors->first('referral_code') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                          <input type="submit" value="Next" class="btn submit-button">
                                        </div>
                                    </div>
                            </div>


                        </form>
                        <div class="form-footer">
                          <div class="sign-in-area">
                              <p>Already have an account? <a href="{{Route('login')}}" class="my-custom-link"> click here.</a></p>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!-- registration page body -->

    <!---------- popup area -------------->
  <div class="modal fade" id="signupModalBtn" tabindex="-1" role="dialog" aria-labelledby="forgotModalBtnLabel" aria-hidden="true">
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

          <form id="verify-otp-form" class="custom-form" action="{{route('verify-otp')}}" method="post">
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
                    <a href="{{route('resend-otp')}}" id="resend-otp" class="resend-otp"> Resend OTP </a>
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