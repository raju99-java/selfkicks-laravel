

<!------ header ------->

    @if (Auth()->guard('frontend')->guest())
        
        <section class="custom-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="logo-area">
                            <a href="{{Route('/')}}" >
                            <img src="{{ URL::asset('public/frontend/img/selfkicks.png')}}" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="button-area float-right">
                            <a href="{{Route('login')}}" class="btn btn-lg btn-purple">Sign In</a>
                        </div> 
                    </div>
                </div>
            </div>
        </section>

    @else
        
        <!------ main header ------->
            <div class="site-mobile-menu site-navbar-target">
                <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icofont-close-line-circled js-menu-toggle"></span>
                </div>
                </div>
                <div class="site-mobile-menu-body"></div>
            </div>
            <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
                <div class="container-fluid">
                <div class="row align-items-center position-relative">
                    <div class="site-logo">
                    <a href="{{Route('/')}}" class="logo-img">
                        <img src="{{ URL::asset('public/frontend/img/selfkicks.png')}}" class="img-fluid" alt="Header Logo">
                    </a>
                    </div>
                    <div class="col-12">
                    <nav class="site-navigation custom-nav-alignment" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                        <li>
                            <a href="{{Route('/')}}" class="nav-link">Home</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Tv Shows</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Movies</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">new & popular</a>
                        </li>
                        <li>
                            <a href="{{route('watch-list')}}" class="nav-link">my list</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">browse by languages</a>
                        </li>
                        <li class="has-children">
                            <a href="Javascript:void(0);" class="nav-link">
                                <img src="{{ URL::asset('public/frontend/img/my-account.png')}}" class="img-fluid">
                                <span class="user-text desktop-hide">Hi User</span>
                            </a> 
                            <ul class="dropdown arrow-top">
                                <li>
                                <a href="{{Route('my-profile')}}" class="nav-link"><span class="account-i"><i class="fa fa-pencil" aria-hidden="true"></i></span> manage profile</a>
                                </li>

                                @if(!Auth()->guard('frontend')->guest())
                                    @if(Auth::guard('frontend')->user()->kyc_verified == '0')
                                        <li>
                                        <a href="{{Route('kyc-details')}}" class="nav-link"><span class="account-i"><i class="fa fa-shield" aria-hidden="true"></i></span> Kyc details</a>
                                        </li>
                                    @endif
                                @endif

                                <li>
                                <a href="{{Route('account')}}" class="nav-link"><span class="account-i"><i class="fa fa-user-o" aria-hidden="true"></i></span> account</a>
                                </li>
                                <li>
                                <a href="{{Route('logout')}}" class="nav-link"><span class="account-i"><i class="fa fa-sign-out" aria-hidden="true"></i></span> Sign Out</a>
                                </li>
                                <!-- <li class="text-center border-add">
                                    <a href="#" class="nav-link">help center</a></li></a>
                                </li> -->
                            </ul>
                        </li>
                        <!-- <li class="has-children">
                            <a href="#" class="nav-link">browse by languages</a>
                            <ul class="dropdown arrow-top">
                                <li>
                                <a href="#" class="nav-link">Test One</a>
                                </li>
                                <li>
                                <a href="#" class="nav-link">Test Two</a>
                                </li>
                                <li>
                                <a href="#" class="nav-link">Test Three</a>
                                </li>
                            </ul>
                        </li> -->
                        </ul>
                    </nav>
                    </div>
                    <div class="toggle-button d-inline-block d-lg-none">
                    <a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black">
                        <span class="fa fa-bars h3"></span>
                    </a>
                    </div>
                </div>
                </div>
            </header>
        <!------//main header ----->

    @endif

<!------// header ----->

