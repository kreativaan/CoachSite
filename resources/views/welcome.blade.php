<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vue in Laravel</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>
    <nav>
        <a href="/about">About</a>
        <a href="/trainer">Trainer</a>
        <a href="/contact">Contact</a>
    </nav>
    <h1>Laravel + Vue Example</h1>

    <div id="app">
        <nav-bar></nav-bar>

        <example-component></example-component>
    </div>
</body>

</html>
