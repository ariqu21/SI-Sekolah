<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width,initial-scale=1">

<title>@yield('title')</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body>

@include('components.inti.sidebar')

<div class="main-content">

@include('components.inti.topbar')

<div class="container-fluid">

@yield('content')

</div>

</div>

<script src="{{ asset('js/admin.js') }}"></script>

</body>

</html>