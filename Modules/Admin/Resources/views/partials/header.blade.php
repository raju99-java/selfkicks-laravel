<?php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);
?>
<!-------- Mobile view menu section -------->
<div class="mobile-view">
    <div class="logo-sec">
        <div class="clearfix d-flex">
            <div class="col-xs-6 col-6">
                <a href="{{ Route('admin-profile') }}"><img src="{{ URL::asset('public/backend/images/logo.png') }}" alt="" class="img-responsive"></a>
            </div>
            <div class="col-xs-6 col-6 text-right">
                <a href="javascript:void(0);" id="MobilesidebarToggle" class="bgr-mnu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.855" height="13.913" viewBox="0 0 26.855 13.913"><defs><style>.b{fill: #0070c0;}</style></defs><g transform="translate(0 -3)"><path class="b" d="M7.238,124.886H1.109a1.109,1.109,0,1,1,0-2.218H7.238a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 -113.82)"/><path class="a" d="M25.736,2.218H1.119A1.109,1.109,0,1,1,1.119,0H25.736a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 3)"/><path class="a" d="M16.37,247.55H1.109a1.109,1.109,0,0,1,0-2.218H16.37a1.109,1.109,0,0,1,0,2.218Zm0,0" transform="translate(0 -230.636)"/></g></svg>
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="mobile-menu-link" style="display: none;">
        <ul>
            <li class="{{ ($controller=='DashboardController') ? 'active' : '' }}"><a href="{{ Route('admin-dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
            <li class="accordion-menu" id="accordion-menus">
                          <!-- <a href="javascript:;" class="dash_menu_icon_4 ">
                                Site Management <i class="fa fa-plus ml-auto" aria-hidden="true"></i><i class="fa fa-minus ml-auto" aria-hidden="true"></i>
                            </a> -->
                <a href="javascript:void(0);"><i class="fa fa-cogs" style="margin-right: 15px; font-size: 1.15rem;"></i> Site Management<i class="fa fa-plus ml-auto" aria-hidden="true"></i><i class="fa fa-minus ml-auto" aria-hidden="true"></i></a>

                <ul class="submenu ml-3" style="display:none;">
                    <li class="{{ ($controller=='SettingsController') ? 'active' : '' }}">
                        <a href="{{Route('settings')}}" class="subcategory-search-list">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <span class="title">Settings</span>
                        </a>
                    </li>
                    <!-- <li class="{{ ($controller=='CmspageController') ? 'active' : '' }}">
                        <a href="{{Route('cmspage')}}" class="subcategory-search-list">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span class="title">CMS Page Management</span>
                            <span class="selected"></span>

                        </a>
                    </li> -->
                    <li class="{{ ($controller=='CmsController') ? 'active' : '' }}">
                        <a href="{{Route('cms')}}" class="subcategory-search-list">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span class="title">CMS Management</span>
                            <span class="selected"></span>

                        </a>
                    </li>
                        <li class="{{ ($controller=='EmailNotificationController') ? 'active' : '' }}">
                            <a href="{{Route('emailNotification')}}" class="subcategory-search-list">
                                <i class="fa fa-envelope-open" aria-hidden="true"></i>
                                <span class="title">Email Management</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
            
            <!--            <li class="nav-item {{ ($controller=='StaticpageController') ? 'active' : '' }}">
                            <a href="{{ Route('static-page.index') }}" class="nav-link nav-toggle">
                                <i class="fa fa-file-text"></i>
                                <span class="title">Static Pages</span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                        </li>-->

            
            
            <!-- <li class="{{ ($controller=='NotificationController') ? 'active' : '' }}"><a href="{{Route('admin-notification-index')}}"><i class="fa fa-bell" aria-hidden="true"></i> Notification</a></li> -->
            
            <li class="nav-item {{ ($controller=='SliderController') ? 'active' : '' }}">
                <a href="{{ Route('admin-slider-index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-picture-o"></i>
                    <span class="title">Sliders</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="{{ ($controller=='EnquiryController') ? 'active' : '' }}">
                <a href="{{Route('enquiry')}}">
                    <i class="fa fa-question"></i> 
                    Enquiry
                </a>
            </li>

            <li class="nav-item {{ ($controller=='VideoController') ? 'active' : '' }}">
                <a href="{{ Route('video') }}" class="nav-link nav-toggle">
                    <i class="fa fa-video-camera"></i>
                    <span class="title">Videos</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item {{ ($controller=='PlanController') ? 'active' : '' }}">
                <a href="{{Route('subscription')}}" class="nav-link nav-toggle">
                    <i class="icofont-brand-axiata"></i> 
                    <span class="title">Subscription Plans</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item {{ ($controller=='UserController') ? 'active' : '' }}">
                <a href="{{ Route('user') }}" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Users</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item {{ ($controller=='NormalMemberController') ? 'active' : '' }}">
                <a href="{{ Route('normal-member') }}" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Normal Members</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item {{ ($controller=='PremiumMemberController') ? 'active' : '' }}">
                <a href="{{ Route('premium-member') }}" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Premium Members</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item {{ ($controller=='KycRequestController') ? 'active' : '' }}">
                <a href="{{ Route('kyc-request-list') }}" class="nav-link nav-toggle">
                    <i class="fa fa-shield"></i>
                    <span class="title">KYC Requests</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item {{ ($controller=='PlanHistoryController') ? 'active' : '' }}">
                <a href="{{ Route('plan-history-list') }}" class="nav-link nav-toggle">
                    <i class="fa fa-history"></i>
                    <span class="title">Subscription History</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>
            
            <li><a href="{{ Route('admin-logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
        <div class="top-right-btn">      
            <ul class="list-inline header-top pull-right">
                <!--<li>-->
                <!--    <a href="#" class="icon-info">-->
                <!--        <i class="dash_menu_icon_7"></i>-->
                <!--        <span class="label label-primary"></span>-->
                <!--    </a>-->
                <!--</li>-->
                <li class="">
                    <div class="dropdown dash-drop">
                        <span data-toggle="dropdown" aria-expanded="false">
                            <img class="img-responsive rounded-circle headr-prof-pic" src="{{URL::asset('public/uploads/user/'.Auth::guard('backend')->user()->image)}}" onerror="this.src='{{ URL::asset('public/backend/images/user.jpg') }}';" alt="">
                                <h1>{{!empty(Auth::guard('backend')->user()->full_name)?Auth::guard('backend')->user()->full_name:'Admin'}} <i class="icofont-caret-down"></i></h1>
                        </span>
                        <ul class="dropdown-menu nw-drp">
                            <li><a href="{{ Route('admin-profile') }}" data-original-title="" title=""><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</a></li>
                            <li><a href="{{ Route('admin-logout') }}" data-original-title="" title=""><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-------- End Mobile view menu section -------->
