<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Style CSS  -->
    <link rel="stylesheet" href="{{ mix('css/shop.css') }}">
    <!-- Icon CSS  -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/free.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- Datepicker CSS  -->
    <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
</head>

<body class="c-app">
    @include('shop::includes.sidebar')
    <div class="c-wrapper c-fixed-components">
        <div class="c-body">
            @include('shop::includes.header')
            <main class="main">
                @yield('shop::content_header')
                <div class="container-fluid">
                    <div class="fade-in">
                        @include('shop::includes.messages')
                        @yield('shop::content')
                    </div>
                </div>
            </main>
            @include('shop::includes.footer')
        </div>
    </div>
    <!-- Js  -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ mix('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ mix('js/shop.js') }}"></script>
    <!-- Latest Toast JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Datepicker JavaScript -->
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    @stack('middle-scripts')
</body>

</html>
