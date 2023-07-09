<?php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);
?>

<div class="user-left-side">
    <div class="side-bar-menu">      
        <!--<a href="#" class="big-logo"><img src="{{ URL::asset('assets/backend/images/dash_logo.png') }}" class="img-responsive"></a>-->
        <a href="{{ Route('admin-dashboard') }}" class="big-logo"><img src="{{ URL::asset('public/backend/images/logo.png') }}" class="img-responsive"></a>
        <!--<a href="{{ Route('admin-dashboard') }}" class="big-logo">odisha_one</a>-->
        <a href="javascript:void(0);" class="berger" id="sidebarToggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="26.855" height="13.913" viewBox="0 0 26.855 13.913"><defs><style>.a{fill:#8898aa;}</style></defs><g transform="translate(0 -3)"><path class="a" d="M7.238,124.886H1.109a1.109,1.109,0,1,1,0-2.218H7.238a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 -113.82)"/><path class="a" d="M25.736,2.218H1.119A1.109,1.109,0,1,1,1.119,0H25.736a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 3)"/><path class="a" d="M16.37,247.55H1.109a1.109,1.109,0,0,1,0-2.218H16.37a1.109,1.109,0,0,1,0,2.218Zm0,0" transform="translate(0 -230.636)"/></g></svg>
            <div class="clearfix"></div>
        </a>
    </div>
    <h1 class="left_top_menu_heading"></h1>
    <ul>
        <li class="{{ ($controller=='DashboardController') ? 'active' : '' }}"><a href="{{ Route('admin-dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        <li class="accordion-menu" id="accordion-menu">
            <a href="javascript:void(0);"><i class="fa fa-cogs" style="margin-right: 15px; font-size: 1.15rem;;"></i> Site Management <i class="fa fa-plus ml-auto" aria-hidden="true"></i><i class="fa fa-minus ml-auto" aria-hidden="true"></i></a>

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
        
<!--        <li class="nav-item {{ ($controller=='StaticpageController') ? 'active' : '' }}">
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
</div>

@if(in_array($controller, ['SettingsController','EmailNotificationController','CmspageController','CmsController','FaqController']))
<script>
    $(window).on('load', function () {
        $('#accordion-menu').trigger('click');
        $('#accordion-menus').trigger('click');
    });
</script>
@endif
@if(in_array($controller, ['ApplyController']))
<script>
    $(window).on('load', function () {
        $('#apply').trigger('click');
        $('#applies').trigger('click');
    });
</script>
@endif