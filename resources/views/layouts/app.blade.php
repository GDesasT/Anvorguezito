<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"> --}}
    @vite('resources/css/app.css')
    <title>Ñeco el muñeco</title>
</head>
<body class="min-h-screen bg-gradient-to-b from-slate-100 to-slate-300 ">
    @include('layouts.nav')

    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <footer>
        @yield('footer')
    </footer>
</body>
</html>
<style>
    *{
        font-family: 'Montserrat';
    }
</style>
