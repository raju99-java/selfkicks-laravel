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
                              Reset Your Password
                            </h1>
                            <!-- <p class="text-black-50">We will send you an email with instructions on how to reset your password.</p> -->
                        </div>
                        <form id="reset-password-form" class="custom-form" action="{{route('set-password')}}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="formRow">
                                        <div class="formRow--item">
                                            <label for="emailid" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="text" name="email" class="formRow--input js-input form-control black-input-box" id="emailid" placeholder="Enter Your Email ID" value="<?php
                                                                                        if (isset($_COOKIE['email']) && $_COOKIE['email'] !== NULL) {
                                                                                            echo $_COOKIE['email'];
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
                                            <label for="passwordid" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="password" name="password" class="formRow--input js-input form-control black-input-box" id="passwordid" placeholder="Enter Your New Password">
                                            </label>
                                            <span class="help-block" id="error-password">{{ $errors->first('password') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="formRow">
                                        <div class="formRow--item">
                                            <label for="cpasswordid" class="formRow--input-wrapper js-inputWrapper">
                                                <input type="password" name="retype_password" class="formRow--input js-input form-control black-input-box" id="cpasswordid" placeholder="Confirm Your Password">
                                            </label>
                                            <span class="help-block" id="error-retype_password">{{ $errors->first('retype_password') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <!-- <button type="button" class="btn submit-button" data-toggle="modal" data-target="#forgotModalBtn">CONTINUE</button> -->
                                        <input type="submit" value="SUMBIT" class="btn submit-button">
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
  

  
  
  

@stop

@section('page_js')


@endsection