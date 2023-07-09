<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript">
        var full_path = '<?= url('/') . '/'; ?>';
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="decription" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Selfkicks">
    <meta name="country" content="india">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{env('APP_NAME', 'Self Kicks')}}</title>
    <!------ theme color ---->
    <meta name="theme-color" content="#000">
    <meta name="msapplication-navbutton-color" content="#000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <!------ theme color ---->
    <!-------- favicon ------>
    <link rel="icon" href="{{ URL::asset('public/frontend/img/favicon.png')}}">
    <!------ stylesheet ----->
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/bootstrap.min.css')}}">
    <!---- owl carousel ----->
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/owl.theme.default.css')}}">
    <!----- font awesome ---->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!------- icofont ------->
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/icofont.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/icofont.min.css')}}">
    <!------ custom css ------>
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/stylesheet.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/responsive.css')}}">

    <!-- header css -->
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/header-style.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.css')}}">
    
</head>
<body>
        @if(Route::is('signup'))
            <section class="wrapper" id="registration-bg">
        @elseif(Route::is('login'))
            <section class="wrapper" id="login-bg">
        @elseif(Route::is('forgot-password'))
            <section class="wrapper" id="forgot-bg">
        @elseif(Route::is('reset-password'))
            <section class="wrapper" id="forgot-bg">
        @else
            <section class="wrapper">
        @endif
            @include('partials.header')
            
            @yield('content')

            @if(Route::is('signup'))
                <section class="footer" style="background: #101011bd !important;" >
            @elseif(Route::is('login'))
                <section class="footer" style="background: #101011bd !important;" >
            @elseif(Route::is('forgot-password'))
                <section class="footer" style="background: #101011bd !important;" >
            @elseif(Route::is('reset-password'))
                <section class="footer" style="background: #101011bd !important;" >
            @else
                <section class="footer">
            @endif
            
                @include('partials.footer')

            </section>

            <!-------- back to top ------------>
            <a id="back2Top" title="Back to top" href="#"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
        </section>
        <!----------- js -------->
        <script src="{{ URL::asset('public/frontend/js/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('public/frontend/js/popper.min.js')}}"></script>
        <script src="{{ URL::asset('public/frontend/js/bootstrap.min.js')}}"></script>

        <!-- header css -->
        <script src="{{ URL::asset('public/frontend/js/jquery.sticky.js')}}"></script>
        <script src="{{ URL::asset('public/frontend/js/main.js')}}"></script>
        <!-- owl carousel -->
        <script src="{{ URL::asset('public/frontend/js/owl.carousel.min.js')}}"></script>

        <script src="{{ URL::asset('public/frontend/js/custom.js')}}"></script>

        <script src="{{ URL::asset('public/frontend/custom/js/script.js')}}" type="text/javascript"></script>

        <script src="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.js')}}"></script>

        @yield('page_js')

        @if(Session::has('error'))
        <input type="hidden" id="error_msg" value="{{ Session::get('error') }}"/>
        <script>
            var error_msg = $('#error_msg').val();
            $.iaoAlert({
                type: "error",
                position: "top-right",
                mode: "dark",
                msg: error_msg,
                autoHide: true,
                alertTime: "9000",
                fadeTime: "1000",
                closeButton: true,
                fadeOnHover: true,
                zIndex: '9999'
            });
            //  swal({
            //   icon: "error",
            //   text: error_msg,
            //   timer: 5000,
            //   button:false
            // });
        </script>
        @endif

        @if(Session::has('success'))
        <input type="hidden" id="success_msg" value="{{ Session::get('success') }}"/>

        <script>
            var success_msg = $('#success_msg').val();
            $.iaoAlert({
                type: "success",
                position: "top-right",
                mode: "dark",
                msg: success_msg,
                autoHide: true,
                alertTime: "9000",
                fadeTime: "1000",
                closeButton: true,
                fadeOnHover: true,
                zIndex: '9999'
            });
            // swal({
            //   icon: "success",
            //   text: success_msg,
            //   timer: 5000,
            //   button:false
            // });
        </script>
        @endif
</body>
</html>