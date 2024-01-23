<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=7">
        <meta name="keywords" content="lobeemo, immo, real state, immobilier, chambre, bureau,appartements,boutiques,studios, villas,studios,Vente e maison, achat de maison, location de maison, annonce immobilières, propiétes a vendre, agence immobilière, courtier immobilier, 
        maison  ">
        <meta name="description" content="Notre site d'immobilier est l'endroit idéal pour trouver votre prochaine maison de rêve. Npus offrons une large selection de propriétés de haut qualités dans le quatiers les plus recherchés de al ville. Avec
        des fonctionnalités de recherche avancées et des outils de compararison de propriétés, il est facile de trouver la maison parfaite qui répond à tous vos besoins.De plus, notre équipe d'expert en immobilier est toujour prêt à vous aider à chaque étape 
        du processus, de la recherche de propiétes à la signature du contract. ">
        <meta name="robots" content="index, follow">
        <meta name="copyright" name="lobeemo">
        <meta name="classification" name="Imobilier, Business">
        <meta name="coverage" name="worldwide">
        <meta name="distribution" content="Gloabl">
        <meta name="rate" content="General">
        <meta name="revisit-after" content="7 days">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="cache-control" content="no-cache">
        <title inertia>{{ config('app.name', 'Lobeemo') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome-pro-5/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-select/css/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/slick/slick.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/magnific-popup/magnific-popup.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/chartjs/Chart.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/dropzone/css/dropzone.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/timepicker/bootstrap-timepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/mapbox-gl/mapbox-gl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/dataTables/jquery.dataTables.min.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/themes.css') }}">

        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
        <script src="{{ asset('assets/vendors/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('assets/vendors/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/slick/slick.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/waypoints/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/counter/countUp.js') }}"></script>
        <script src="{{ asset('assets/vendors/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/dropzone/js/dropzone.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/timepicker/bootstrap-timepicker.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/hc-sticky/hc-sticky.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/jparallax/TweenMax.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/mapbox-gl/mapbox-gl.js') }}"></script>
        <script src="{{ asset('assets/vendors/dataTables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/tiny-slider/tiny-slider.js') }}"></script>
        <script src="{{ asset('assets/js/theme.js') }}"></script>
    </body>
</html>
