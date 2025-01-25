<!DOCTYPE html>
{{-- <html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="horizontal-menu-template"> --}}
<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="{{url ('assets')}}/" data-template="horizontal-menu-template">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ $urlName ?? '' }}</title>

    @include('layouts.inc-stylesheet')
    @yield('stylesheets')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">

            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                @include('layouts.inc-top-menu')
            </nav>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Menu -->
                    @include('layouts.inc-menu')
                    <!-- /Menu -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                © 2024 - 
                <script>
                    document.write(new Date().getFullYear());
                </script>
                ,
                <a href="#" target="_blank" class="footer-link fw-bolder">{{ config('aboutApp.show_app_name') }}</a>
            </div>
            <div>
                <a href="https://www.servicesystemit.com/" class="footer-link me-4" target="_blank">License</a>
            </div>
        </div>
    </footer>
    <!-- / Footer -->
    @include('layouts.inc-script')
    @yield('script')
</body>

</html>
