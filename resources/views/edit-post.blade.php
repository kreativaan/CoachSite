<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 h-full">
    <div id="app">
        <nav-bar></nav-bar>
        <edit-post :id="{{ $id }}"></edit-post>
    </div>
</body>

</html>
