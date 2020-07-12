<!DOCTYPE html>
<html>

<head>
    <title>Nflik Admin template</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('template/bower_components/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/bower_components/slick-carousel/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/main.css?version=4.5.0') }}" rel="stylesheet">
</head>

<body class="menu-position-side menu-side-left full-screen with-content-panel">
    <div class="all-wrapper with-side-panel solid-bg-all">
        {{-- @include('includes.modalpopup')--}}
        {{-- @include('includes.searchpopup') --}}
        <div class="layout-w">
            @include('includes.leftside_bar')
            <div class="content-w">
                @include('includes.top_bar')
                @include('includes.breadcrum')
                <div class="content-panel-toggler">
                    <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
                </div>
                <div class="content-i">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="display-type"></div>
    </div>
    <script src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('template/bower_components/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap-validator/dist/validator.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('template/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/dropzone/dist/dropzone.js')}}"></script>
    <script src="{{ asset('template/bower_components/editable-table/mindmup-editabletable.js')}}"></script>
    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/tether/dist/js/tether.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/slick-carousel/slick/slick.min.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/util.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/alert.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/button.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/carousel.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/collapse.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/dropdown.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/modal.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/tab.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/tooltip.js')}}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/js/dist/popover.js')}}"></script>
    <script src="{{ asset('template/js/demo_customizer.js?version=4.5.0')}}"></script>
    <script src="{{ asset('template/js/main.js?version=4.5.0')}}"></script>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-XXXXXXXX-9', 'auto');
        ga('send', 'pageview');
    </script>
</body>

</html>