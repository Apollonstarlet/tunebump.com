<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{env('APP_NAME')}} | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Mulish" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styling.css')}}">
    @yield('page-style')
</head>
<body style="font-family: Mulish">
    @yield('content')
</body>
</html>