<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ setting('app_name') }}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
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
<!-- Page content -->
<div class="page-content" id="app" style="background: url({{ asset('backend/global_assets/images/login_cover.jpg') }}) no-repeat; background-size: cover;">
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">
            <!-- Login form -->
                @yield('content')
            <!-- /login form -->
        </div>
        <!-- /content area -->
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
<script src="{{ asset('backend/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('backend/global_assets/js/demo_pages/form_checkboxes_radios.js') }}"></script>
<script src="{{ asset('backend/global_assets/js/demo_pages/components_modals.js') }}"></script>

<script src="{{ asset('backend/js/app.js') }}"></script>
<script src="{{ asset('backend/global_assets/js/demo_pages/login.js') }}"></script>
<!-- /theme JS files -->
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

<script src="{{ asset('backend/js/app.backend.js') }}"></script>
@stack('footer')
</body>
</html>