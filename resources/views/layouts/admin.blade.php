<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Админпанель для сайта east-expert.com</title>
</head>

<body class="app sidebar-mini rtl">
<!-- Start. Header-->
@yield('header')
<!-- End. Header-->

<!-- Start. Sidebar menu-->
@yield('sidebar')
<!-- End. Sidebar menu-->

<!-- Start. Content-->
@yield('content')
<!-- End. Content-->
</body>
</html>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    CKEDITOR.replace( 'intro' );
</script>