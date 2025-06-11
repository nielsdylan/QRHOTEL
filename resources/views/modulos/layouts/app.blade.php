<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/images/brand/favicon.ico') }}">

    <!-- TITLE -->
    <title>Sash – Bootstrap 5 Admin & Dashboard Template</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('template/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- STYLE CSS -->
     <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">

	<!-- Plugins CSS -->
    <link href="{{ asset('template/css/plugins.css') }}" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('template/css/icons.css') }}" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="{{ asset('template/switcher/css/switcher.css') }}" rel="stylesheet">
    <link href="{{ asset('template/switcher/demo.css') }}" rel="stylesheet">
    @yield('style')
</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('template/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('modulos.layouts.header')
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            @include('modulos.layouts.sidebar')
            <!--/APP-SIDEBAR-->

            <!--app-content open-->
            @yield('content')
            <!--app-content closed-->
        </div>

        <!-- Sidebar-right -->
        @include('modulos.layouts.sidebar-right')
        <!--/Sidebar-right-->

        <!-- Country-selector modal-->
        @include('modulos.layouts.country-selector')
        <!-- Country-selector modal-->

        <!-- FOOTER -->
        @include('modulos.layouts.footer')
        <!-- FOOTER CLOSED -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <script>
        const token = '{{csrf_token()}}';
        let asset = '{{ asset('') }}';
    </script>
    @routes
    @include('modulos.layouts.js')

    <script>

        const hotel = new HotelView(new HotelModel(token));
        hotel.iniciar();
    </script>

    @yield('script')
    <script>
        $(function(e) {
            "use strict";

            // Select2
            $('.select2').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            // Select2 by showing the search
            $('.select2-show-search').select2({
                minimumResultsForSearch: '',
                width: '100%'
            });

            // select2-search__field
            $('.select2').on('click', () => {
                let selectField = document.querySelectorAll('.select2-search__field')
                selectField.forEach((element, index) => {
                    element.focus();
                })
            });

        });

    </script>
</body>

</html>
