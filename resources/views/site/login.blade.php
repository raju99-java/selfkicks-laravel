@extends('layouts.main')

@section('content')

    
        
<!-- login page body -->
<div class="section-body custom-form-boby-upper-gap login">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6 offset-sm-3">
                <div class="inner-login-body form-gapping">
                    <div class="form-heading p-top20 p-bottom20">
                        <h1 class="custom-white-title">Sign In</h1>
                        <p>Enter your credentials to continue.</p>
                    </div>
                    <form id="login-form" class="custom-form" action="{{route('login')}}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="formRow">
                                    <div class="formRow--item">
                                        <label for="emailid" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="text" name="email" class="formRow--input js-input form-control black-input-box" id="emailid" placeholder="Email ID" value="<?php
                                                                                        if (isset($_COOKIE['email']) && $_COOKIE['email'] !== NULL) {
                                                                                            echo $_COOKIE['email'];
                                                                                        }
                                                                                        ?>">
                                        </label>
                                        <span class="help-block" id="error-email">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="formRow">
                                    <div class="formRow--item">
                                        <label for="passwordid" class="formRow--input-wrapper js-inputWrapper">
                                            <input type="password" name="password" class="formRow--input js-input form-control black-input-box" id="passwordid" placeholder="Your password" value="<?php
                                                                                                if (isset($_COOKIE['password']) && $_COOKIE['password'] !== NULL) {
                                                                                                    echo $_COOKIE['password'];
                                                                                                }
                                                                                                ?>" >
                                        </label>
                                        <span class="help-block" id="error-password">{{ $errors->first('password') }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <input type="checkbox" id="remember" name="rememberMe" value="1">
                                <label class="remember-me-label" for="Remember Me">Remember Me</label> 
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" value="Sign In" class="btn submit-button">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-footer">
                        <div class="sign-in-area">
                            <p>Forgot Your Password? <a href="{{Route('forgot-password')}}" class="my-custom-link"> click here.</a></p>
                            <p>New to selfkicks? <a href="{{Route('signup')}}" class="my-custom-link"> Sign up now.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<!-- login page body -->


@stop

@section('page_js')


@endsection