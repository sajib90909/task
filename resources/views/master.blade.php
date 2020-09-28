<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('/') }}css/style.css" rel="stylesheet">
    <link href="{{ asset('/') }}css/all.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">
    @yield('content')
</body>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('/') }}js/jquery.min.js"></script>
<script src="{{ asset('/') }}js/bootstrap.min.js"></script>
<script src="{{ asset('/') }}js/main.js"></script>
</html>
