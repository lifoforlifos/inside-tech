<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Icon -->
        <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>

        <title>Inside Technologie</title>

        <!-- Stripe -->
        <script src="https://js.stripe.com/v3/"></script>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles/bootstrap4/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/OwlCarousel2-2.2.1/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles/main_styles.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles/responsive.css') }}">
    </head>
    <body>
        <div id="admin"></div>

        <script type="text/javascript" src="{{ mix('js/admin.js') }}"></script>

        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('css/styles/bootstrap4/popper.js') }}"></script>
        <script src="{{ asset('css/styles/bootstrap4/bootstrap.min.js') }}"></script>
        <script src="{{ asset('css/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('css/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
        <script src="{{ asset('css/plugins/easing/easing.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>
