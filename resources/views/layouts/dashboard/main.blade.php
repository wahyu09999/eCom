<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('templates/dashboard')}}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{asset('templates/dashboard')}}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
        @yield('title') - Electronic Online Shop
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('templates/dashboard')}}/css/material-dashboard.css" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('templates/dashboard')}}/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
    <div class="wrapper ">
        @include('layouts.dashboard.sidebar')
        <div class="main-panel">
            @include('layouts.dashboard.navbar')
            @yield('content')
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright float-right">
                        &copy; <script>
                            document.write(new Date().getFullYear());

                        </script>
                        , All right reversed.
                    </div>
                </div>
            </footer>
            @yield('modal')
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{asset('templates/dashboard')}}/js/core/jquery.min.js"></script>
    <script src="{{asset('templates/dashboard')}}/js/core/popper.min.js"></script>
    <script src="{{asset('templates/dashboard')}}/js/core/bootstrap-material-design.min.js"></script>
    <script src="{{asset('templates/dashboard')}}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="{{asset('templates/dashboard')}}/js/plugins/moment.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="{{asset('templates/dashboard')}}/js/plugins/arrive.min.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('templates/dashboard')}}/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{asset('templates/dashboard')}}/demo/demo.js"></script>
    <script type="text/javascript">
        var APP_URL = "{!! url('/') !!}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    @yield('script')
</body>

</html>
