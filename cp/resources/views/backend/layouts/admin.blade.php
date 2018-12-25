<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ setting('app_name') }}</title>

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('backend/images/icons/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('backend/images/icons/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('backend/images/icons/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('backend/images/icons/favicon-16x16.png') }}" sizes="16x16" />
    <meta name="application-name" content="{{ setting('app_name') }}"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('backend/images/icons/mstile-144x144.png') }}" />

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/global_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <link rel="stylesheet" href="{{ asset('backend/css/app.backend.css') }}">

    @stack('header')
</head>

<body>
    <!-- Main navbar -->
    @include('backend.partials.navbar-main')
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content" id="app">
        <!-- Main sidebar -->
        @include('backend.partials.sidebar-main')
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            @include('backend.partials.header')
            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /content area -->
            <!-- Footer -->
            @include('backend.partials.footer')
            <!-- /footer -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
    <!-- Core JS files -->
    <script src="{{ asset('backend/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script src="{{ asset('backend/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/styling/switch.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/tables/footable/footable.min.js') }}"></script>
    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script src="{{ asset('backend/js/form_checkboxes_radios.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/table_responsive.js') }}"></script>
    <!-- Laravel Javascript Validation -->
    <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    <script src="{{ asset('backend/js/app.backend.js') }}"></script>
@stack('footer')
</body>
</html>
