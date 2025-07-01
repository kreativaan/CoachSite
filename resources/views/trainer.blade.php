<!DOCTYPE html>
<html lang="en" style="height: 100%">

<head>
    <meta charset="UTF-8">
    <title>Trainer Profile</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="bg-gray-100 pb-10">
        <nav-bar></nav-bar>
        <trainer-profile></trainer-profile>
    </div>
</body>

</html>
