<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div id="app">
        <nav-bar></nav-bar>
        <blog-post :id="{{ $id }}"></blog-post>
    </div>
</body>

</html>
