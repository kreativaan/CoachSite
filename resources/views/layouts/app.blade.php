@props(['title' => 'CoachSite'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        console.log("Auth from Blade:", @json(Auth::user()));
        window.authUser = @json(Auth::user());
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 text-gray-800">
    <div id="app">
        <nav-bar></nav-bar>

        <main class="min-h-screen">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
