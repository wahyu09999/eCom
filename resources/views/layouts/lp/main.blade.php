<!DOCTYPE html>
<html lang="en">

<!-- ecolife/index-12.html - Rezayo Technology - 09:21:57 GMT -->
<!-- Buy from Rezayo Technology -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Buy from Rezayo Technology -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <title>@yield('title') - Olshop Electronic</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('templates/landing-page')}}/images/favicon/favicon.png" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800&amp;display=swap" rel="stylesheet" />

    <!-- All CSS Flies   -->
    <!--===== Vendor CSS (Bootstrap & Icon Font) =====-->
    <!-- <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/plugins/bootstrap.min.css" />
        <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/plugins/font-awesome.min.css" />
        <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/plugins/ionicons.min.css" /> -->
    <!--===== Plugins CSS (All Plugins Files) =====-->
    <!-- <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/plugins/jquery-ui.min.css" />
        <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/plugins/meanmenu.css" />
        <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/plugins/nice-select.css" />
        <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/plugins/owl-carousel.css" />
        <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/plugins/slick.css" /> -->
    <!--===== Main Css Files =====-->
    <!-- <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/style.css" /> -->
    <!-- ===== Responsive Css Files ===== -->
    <!-- <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/responsive.css" /> -->

    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->

    <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/vendor/plugins.min.css">
    <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/style.min.css">
    <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/responsive.min.css">
    @yield('css')
</head>

<body class="home-12 home-electronic">
    <!-- main layout start from here -->
    <!--====== PRELOADER PART START ======-->

    <!-- <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div> -->

    <!--====== PRELOADER PART ENDS ======-->
    <div id="main">
        @include('layouts.lp.header')
        @yield('content')
        @include('layouts.lp.footer')
    </div>

    @yield('modal')

    <!-- Scripts to be loaded  -->
    <!-- JS
============================================ -->

    <!--====== Vendors js ======-->
    <script src="{{asset('templates/landing-page')}}/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{asset('templates/landing-page')}}/js/vendor/modernizr-3.7.1.min.js"></script>

    <!--====== Plugins js ======-->
    <!-- <script src="{{asset('templates/landing-page')}}/js/plugins/bootstrap.min.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/popper.min.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/meanmenu.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/owl-carousel.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/jquery.nice-select.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/countdown.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/elevateZoom.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/jquery-ui.min.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/slick.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/scrollup.js"></script>
        <script src="{{asset('templates/landing-page')}}/js/plugins/range-script.js"></script> -->

    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->

    <script src="{{asset('templates/landing-page')}}/js/plugins.min.js"></script>

    <!-- Main Activation JS -->
    <script src="{{asset('templates/landing-page')}}/js/main.js"></script>
    <script type="text/javascript">
        var APP_URL = "{!! url('/') !!}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getCount() {
            $.get(`${APP_URL}/api/get-count-cart`, function(data) {
                if (data == 0) {
                    $('.count-cart').attr('data-count', 0);
                }
                $('.count-cart').attr('data-count', data);
            });
        }
        setInterval(getCount, 1000);

    </script>
    @yield('script')

</body>
</html>
