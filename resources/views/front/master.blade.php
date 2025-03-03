<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ asset('assets') }}/">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> MailGram </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    @livewireStyles
    @stack('style')
</head>

<body class="@if (route('auth.login') && !auth()->user()) bg-[#212121] @else bg-[#0f0f0f] @endif h-screen">
    {{ $slot }}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @livewireScripts



    @stack('script')
</body>

</html>
