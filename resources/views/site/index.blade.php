@extends('layouts.main')

@section('content')


<!-- banner area ---->
<section class="big-banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="big-content">
                            <h1>
                                Unlimited movies, TV shows and more.
                            </h1>
                            <h3>Watch anywhere.</h3>
                            <div class="banner-sub-content">
                                <p>Ready to watch? Enter your email to create or restart your membership.</p>
                            </div>   
                            <div class="get-started-form">
                                <form  class="get-started" method="post" action="{{route('get-started')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 padding-desktop-remove">
                                            <div class="formRow">
                                                <div class="formRow--item">
                                                    <label for="emailid" class="formRow--input-wrapper js-inputWrapper">
                                                        <input type="text" name ="email" class="formRow--input js-input form-control white-input-box border-radious-none" id="emailid" placeholder="Enter Your Email ID" value="<?php
                                                                if (isset($_COOKIE['started_email']) && $_COOKIE['started_email'] !== NULL) {
                                                                    echo $_COOKIE['started_email'];
                                                                }
                                                                ?>" >
                                                    </label>
                                                    <span class="help-block" id="error-email">{{ $errors->first('email') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 padding-desktop-remove">
                                           <button type="submit" class="btn get-started-btn">Get Started <span><i class="fa fa-angle-right" aria-hidden="true"></i></span></button> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </section>
        <!-- //banner area -->
        
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->

        <!--- banner below div ---->
        <section class="below-banner-div mobile-upper-gap lower-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="banner-below-div-content-area">
                            <h3>Enjoy on your TV.</h3>
                            <p>Watch on smart TVs, PlayStation, Xbox, Chromecast, Apple TV, Blu-ray players and more.</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="rt-contents">
                            <div class="image-contain">
                            <img src="{{ URL::asset('public/frontend/img/tv.png')}}" alt="image" class="img-fluid">
                            </div>
                            <div class="video-contain">
                            <video width ="100%" height="100%" src="{{ URL::asset('public/frontend/img/video-tv-.m4v')}}" type="video/mp4"></video>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>    
        </section>
        <!--- //banner below div --->
        
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->

        <!--- banner below div ---->
        <section class="below-banner-div mobile-upper-gap lower-gap">
            <div class="container">
                <div class="row align-items-center flex-column-reverse flex-lg-row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="lft-img">
                            <div class="main-img">
                              <img src="{{ URL::asset('public/frontend/img/section-2.jpg')}}" alt="image" class="img-fluid">
                            </div>
                            <div class="bottom-box">
                              <div class="book">
                                <img src="{{ URL::asset('public/frontend/img/boxshot.png')}}" alt="image" class="img-fluid">
                              </div> 
                              <div class="lines">
                                <p class="top-line">stranger things</p>
                                <p class="line-2">downloading ...</p>
                              </div> 
                              <div class="download-icon">
                                <img src="{{ URL::asset('public/frontend/img/download-arrow.gif')}}" alt="image" class="img-fluid">
                              </div> 
                            </div>
                          </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="banner-below-div-content-area">
                            <h3>Earn Points With Watching Videos.</h3>
                            <p>Save your favourites easily and always have something to watch.</p>
                        </div>
                    </div>
                    
                </div>
            </div>    
        </section>
        <!--- //banner below div --->

        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->

        <!--- banner below div ---->
        <section class="below-banner-div uper-gap lower-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="banner-below-div-content-area">
                            <h3>Watch everywhere.</h3>
                            <p>Stream unlimited movies and TV shows on your phone, tablet, laptop, and TV.</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="right-col">
                            <div class="image-box">
                              <img src="{{ URL::asset('public/frontend/img/section-3.png')}}" alt="image" class="img-fluid">
                            </div>
                            <div class="another-video">
                              <video width="90%" height="100%" src="{{ URL::asset('public/frontend/img/sectn-3-vd.m4v')}}" type="video/mp4" autoplay="" muted=""></video>
                            </div>  
                         </div>
                    </div>
                </div>
            </div>    
        </section>
        <!--- //banner below div --->

        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->


        <!--- banner below div ---->
        <section class="below-banner-div uper-gap lower-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="right-col">
                            <div class="kid-img">
                                <img src="{{ URL::asset('public/frontend/img/prime-video.png')}}" class="img-fluid" alt="image" >
                            </div>
                         </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="banner-below-div-content-area">
                            <h3>Prime Video - Daily 2 Videos In A Day.</h3>
                            <p>Send children on adventures with their
                               favourite characters in a space made just for
                               them—free with your membership.
                            </p>
                        </div>
                    </div>
                </div>
            </div>    
        </section>
        <!--- //banner below div --->


        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->

        <!------- faq area ----------->
        <section class="faq-area uper-gap lower-gap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="banner-below-div-content-area text-center">
                            <h3>Frequently Asked Questions</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                        <div class="main-accordian-area">
                            <button class="custom-accordion">What is Selfkicks?</button>
                            <div class="panel">
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                            </div>

                            <button class="custom-accordion">How Much Does Selfkicks Cost?</button>
                            <div class="panel">
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                            </div>

                            <button class="custom-accordion">Where Can I Watch?</button>
                            <div class="panel">
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                            </div>

                            <button class="custom-accordion">What is Selfkicks?</button>
                            <div class="panel">
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                            </div>

                            <button class="custom-accordion">How Much Does Selfkicks Cost?</button>
                            <div class="panel">
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                            </div>

                            <button class="custom-accordion">Where Can I Watch?</button>
                            <div class="panel">
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                                <p>Selfkicks is a streaming service that offers a wide variety of
                                    award-winning TV shows, movies, anime, documentaries and
                                    more – on thousands of internet-connected devices.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </section>
        <!------- faq area ----------->

        <!---- footer get started ---->
        <section class="footer-upper-get-started">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-sm-8 offset-sm-2">
                        <div class="banner-sub-content">
                            <p>Ready to watch? Enter your email to create or restart your membership.</p>
                        </div>
                        <div class="get-started-form">
                                <form  class="get-started" method="post" action="{{route('get-started')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 padding-desktop-remove">
                                            <div class="formRow">
                                                <div class="formRow--item">
                                                    <label for="emailid" class="formRow--input-wrapper js-inputWrapper">
                                                        <input type="text" name ="email" class="formRow--input js-input form-control white-input-box border-radious-none" id="emailid" placeholder="Enter Your Email ID" value="<?php
                                                                if (isset($_COOKIE['started_email']) && $_COOKIE['started_email'] !== NULL) {
                                                                    echo $_COOKIE['started_email'];
                                                                }
                                                                ?>" >
                                                    </label>
                                                    <span class="help-block" id="error-email">{{ $errors->first('email') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 padding-desktop-remove">
                                           <button type="submit" class="btn get-started-btn">Get Started <span><i class="fa fa-angle-right" aria-hidden="true"></i></span></button> 
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


@stop

@section('page_js')


@endsection

        