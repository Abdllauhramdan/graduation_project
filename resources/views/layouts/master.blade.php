<!-- resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>

    {{-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pharma')</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="{{ asset('../../css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('../../fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('../../fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/style.css') }}">
    <!-- End CSS includes --> --}}
</head>
<body>
<!-- Navbar -->
@include('partials.navbar')

<!-- Main content -->
<div class="container">
    @yield('content')
</div>

<!-- Footer -->
@include('partials.footer')

</body>
</html>
