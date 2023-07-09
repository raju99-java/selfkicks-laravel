@extends('layouts.main')

@section('content')

        <!---------bradecrumbs ---->
        <div class="custombreadcrumbs">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content">
                            <h1>Contact Us</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content-menu">
                            <ul class="list-unstyled">
                                <li class="list-inline-item"><a href="{{route('/')}}">Home</a></li>
                                <li class="list-inline-item"><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                                <li class="list-inline-item">Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------//bradecrumbs ---->
        
        <!------ user dashboard ---->
        <section class="dashboard-bg-area my-5 mx-xl-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 offset-lg-2 offset-md-0">
                        <div class="others-page-bg">
                            <div class="banner-below-div-content-area text-center">
                                <h3>Get In Touch</h3>
                                <p class="small-p">Any Kind of query fill this form now...</p>
                            </div>
                            <form class="custom-form" id="contact-form" action="{{('contact-us')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Name</p>
                                                <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="text" name="name" class="formRow--input js-input form-control black-input-box" id="username" placeholder=""><span class="placeholder">Name</span>
                                                </label>
                                                <span class="help-block" id="error-name">{{ $errors->first('name') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Email</p>
                                                <label for="emailid" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="email" name="email" class="formRow--input js-input form-control black-input-box" id="emailid" placeholder=""><span class="placeholder">Email ID</span>
                                                </label>
                                                <span class="help-block" id="error-email">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Phone Number</p>
                                                <label for="phoneno" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="text" name="phone" class="formRow--input js-input form-control black-input-box" id="phoneno" placeholder=""><span class="placeholder"></span><span class="placeholder">Phone Number</span>
                                                </label>
                                                <span class="help-block" id="error-phone">{{ $errors->first('phone') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Subject</p>
                                                <label for="subject" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="text" class="formRow--input js-input form-control black-input-box" id="subject" name="subject" placeholder=""><span class="placeholder">Subject</span>
                                                </label>
                                                <span class="help-block" id="error-subject">{{ $errors->first('subject') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Message</p>
                                                <label for="message" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="text" name="message" class="formRow--input js-input form-control black-input-box" id="user_address" placeholder="">
                                                    <span class="placeholder">Message</span>
                                                </label>
                                                <span class="help-block" id="error-message">{{ $errors->first('message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center justify-content-center m-top10">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mt-lg-6">
                                        <div class="form-group user-btn">
                                            <input type="submit" value="SUBMIT" class="btn submit-button">
                                        </div>
                                    </div>
                                </div>
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

@section('page_js')


@endsection