<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CoachSite')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        window.authUser = @json(Auth::user());
    </script>
</head>

<body class="bg-gray-100 text-gray-800">
    <div id="app">
        <nav-bar></nav-bar>

        <main class="min-h-screen">
            @yield('content')
        </main>
    </div>
</body>

</html>
